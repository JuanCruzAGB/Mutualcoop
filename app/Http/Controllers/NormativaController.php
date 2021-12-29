<?php
    namespace App\Http\Controllers;

    use App\Models\Enlace;
    use App\Models\Nexo;
    use App\Models\Normativa;
    use App\Models\Obra;
    use App\Models\Organismo;
    use App\Models\Relacion;
    use App\Models\Suscripcion;
    use App\Models\Tema;
    use App\Models\Tipo;
    use Auth;
    use Carbon\Carbon;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;
    use Intervention\Image\ImageManagerStatic as Image;
    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Facades\Validator;
    use Storage;

    class NormativaController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Show the "regulations list" page.
         * @return [type]
         */
        public function listado($tipo_slug = null){
            $usuario = Auth::user();
            $obras = ObraController::getByUsuario($usuario);
            if($tipo_slug){
                $tipo = TipoController::getOne(null, $tipo_slug);
                $normativas = $this::getByObra($obras, $tipo->id_tipo);
            }else{
                $normativas = $this::getByObra($obras);
            }

            foreach($normativas as $normativa){
                $normativa->obras = ObraController::getByNormativa($normativa);
                $normativa->temas = TemaController::getAll($normativa);
                $normativa->tipo_normativa = TipoController::getOne($normativa->id_tipo_normativa);
            };

            if (Auth::user()->id_nivel == 1) {
                $tabs = $this->getSubsTabs();
            } else {
                $tabs = $this->getAdminTabs();
            }

            if ($tipo_slug) {
                $current = $tipo->nombre;
            } else {
                $current = 'undefined';
            }

            return view('normativa.listado', [
                'usuario' => $usuario,
                'normativas' => $normativas,
                'current' => $current,
                'tabs' => $tabs,
                'filtros' => $this->getListadoFiltros($normativas, $tipo_slug),
            ]);
        }

        /**
         * * Show the "regulations table" panel page.
         * @return [type]
         */
        public function panel(){
            $normativas = Normativa::with('tipo', 'relaciones', 'enlaces')->get();

            $tipos = $this::getAll($normativas);
            
            foreach($normativas as $normativa){
                $normativa->obras = ObraController::getByNormativa($normativa);
                $normativa->temas = TemaController::getAll($normativa);
                $normativa->tipo_normativa = TipoController::getOne($normativa->id_tipo_normativa);
            };

            return view('normativa.panel', [
                'usuario' => Auth::user(),
                'normativas' => $normativas,
                'tipos' => $tipos,
                'tabs' => $this->getAdminTabs(),
                'filtros' => $this->getPanelFiltros($normativas),
            ]);
        }

        /**
         * * Show the "create Evento" page.
         * @return [type]
         */
        public function showCrear(){
            $obras = Obra::get();
            $tipos = Tipo::where('id_tipo', '<', '4')->get();
            $organismos = Organismo::get();
            $temas = Tema::with('nexos')->get();

            return view('normativa.crear', [
                'obras' => $obras,
                'tipos' => $tipos,
                'organismos' => $organismos,
                'temas' => $temas,
                'validation' => (object)[
                    'rules' => Normativa::$validation['crear']['rules'],
                    'messages' => Normativa::$validation['crear']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Create a Normativa.
         * @param Request $request
         * @return [type]
         */
        public function doCrear(Request $request){
            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Normativa::$validation['crear']['rules'], Normativa::$validation['crear']['messages']['es']);
            if($validator->fails()){
                return redirect('/panel/normativa/crear')->withErrors($validator)->withInput();
            }

            $input->fecha = Carbon::parse($input->fecha)->format('Y-m-d');
            
            $filepath = $request->file('archivo')->hashName('normativas');
            
            if($request->hasFile('archivo')){
                switch($request->archivo->extension()){
                    case 'pdf':
                        Storage::put('normativas', $request->file('archivo'));
                        break;
                    default:
                        $file = Image::make($request->file('archivo'))
                                ->resize(500, 400, function($constrait){
                                    $constrait->aspectRatio();
                                    $constrait->upsize();
                                });

                        Storage::put($filepath, (string) $file->encode());
                        break;
                }
            }
            
            $input->archivo = $filepath;
            
            $input->id_usuario = Auth::id();

            $input->slug = SlugService::createSlug(Normativa::class, 'slug', $input->titulo);
            
            $normativa = Normativa::create((array) $input);

            foreach($input->temas as $tema){
                $inputEnlace = new \stdClass();
                $inputEnlace->id_normativa = $normativa->id_normativa;
                $inputEnlace->id_tema = $tema;
                Enlace::create((array) $inputEnlace);
            }

            foreach($input->obras as $obra){
                $inputRelacion = new \stdClass();
                $inputRelacion->id_normativa = $normativa->id_normativa;
                $inputRelacion->id_obra = $obra;
                Relacion::create((array) $inputRelacion);
            }
            
            return redirect('/panel/normativas')->with('status', [
                'code' => 200,
                'message' => 'Normativa subida correctamente.',
            ]);
        }
        
        /**
         * * Show the "edit Normativa" page.
         * @param mixed $slug - Normativa slug.
         * @return [type]
         */
        public function showEditar($slug){
            $normativa = Normativa::where('slug', '=', $slug)->get();
            $normativa = $normativa[0];
            $obras = Obra::get();
            $tipos = Tipo::where('id_tipo', '<', '4')->get();
            $organismos = Organismo::get();
            $enlaces = $normativa->enlaces;
            $relaciones = $normativa->relaciones;
            $temas = Tema::with('nexos')->get();
            $normativa->temas = collect([]);
            $obrasToPush = [];
            foreach($enlaces as $enlace){
                $normativa->temas->push($enlace->id_tema);
            }
            foreach($relaciones as $relacion){
                $obrasToPush[] = $relacion->id_obra;
            }
            $normativa->obras = $obrasToPush;

            return view('normativa.editar', [
                'normativa' => $normativa,
                'obras' => $obras,
                'tipos' => $tipos,
                'organismos' => $organismos,
                'temas' => $temas,
                'validation' => (object)[
                    'rules' => Normativa::$validation['editar']['rules'],
                    'messages' => Normativa::$validation['editar']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Edit a Normativa.
         * @param Request $request
         * @param mixed $id_normativa - Normativa primary key.
         * @return [type]
         */
        public function doEditar(Request $request, $id_normativa){
            $normativa = Normativa::find($id_normativa);

            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Normativa::$validation['editar']['rules'], Normativa::$validation['editar']['messages']['es']);
            if($validator->fails()){
                return redirect("/panel/normativa/$normativa->slug/editar")->withErrors($validator)->withInput();
            }

            if(!isset($input->fecha)){
                $input->fecha = $normativa->fecha;
            }

            $input->fecha = Carbon::parse($input->fecha)->format('Y-m-d');
            
            if($request->hasFile('archivo')){
                $archivo_actual = $normativa->archivo;
                
                $filepath = $request->file('archivo')->hashName('normativas');
                
                switch($request->archivo->extension()){
                    case 'pdf':
                        Storage::put('normativas', $request->file('archivo'));
                        break;
                    default:
                        $file = Image::make($request->file('archivo'))
                                ->resize(500, 400, function($constrait){
                                    $constrait->aspectRatio();
                                    $constrait->upsize();
                                });

                        Storage::put($filepath, (string) $file->encode());
                        break;
                }
                
                $input->archivo = $filepath;
            }else{
                $input->archivo = $normativa->archivo;
            }
            
            $input->id_usuario = Auth::id();

            if($normativa->titulo != $input->titulo){
                $input->slug = SlugService::createSlug(Normativa::class, 'slug', $input->titulo);
            }else{
                $input->slug = $normativa->slug;
            }
            
            foreach($normativa->enlaces as $enlace){
                $enlace->delete();
            }

            foreach($normativa->relaciones as $relacion){
                $relacion->delete();
            }

            foreach($input->temas as $tema){
                $inputEnlace = new \stdClass();
                $inputEnlace->id_normativa = $normativa->id_normativa;
                $inputEnlace->id_tema = $tema;
                Enlace::create((array) $inputEnlace);
            }

            foreach($input->obras as $obra){
                $inputRelacion = new \stdClass();
                $inputRelacion->id_normativa = $normativa->id_normativa;
                $inputRelacion->id_obra = $obra;
                Relacion::create((array) $inputRelacion);
            }
            
            if(isset($archivo_actual) && !empty($archivo_actual)){
                Storage::delete($archivo_actual);
            }
            
            $normativa->update((array) $input);
            
            return redirect('/panel/normativas')->with('status', [
                'code' => 200,
                'message' => "La Normativa: \"$normativa->titulo\" fue editada exitosamente.",
            ]);
        }

        /**
         * * Delete a Normativa.
         * @param mixed $id_normativa - Normativa primary key.
         * @return [type]
         */
        public function doEliminar($id_normativa){
            $normativa = Normativa::find($id_normativa);

            if(isset($normativa->archivo) && !empty($normativa->archivo)) {
                Storage::delete($normativa->archivo);
            }

            foreach($normativa->relaciones as $relacion){
                $relacion->delete();
            }

            foreach($normativa->enlaces as $enlace){
                $enlace->delete();
            }
                
            $normativa->delete();
            
            return redirect('/panel/normtivas')->with('status', [
                'code' => 200,
                'message' => "La Normativa fue eliminada exitosamente.",
            ]);
        }

        /**
         * * Get the count of Normativa tipos.
         * @param mixed $normativas - Normativa.
         * @return [type]
         */
        static function getAll($normativas){
            $tipos = (object) [
                'total' => 0,
                'ley' => 0,
                'decreto' => 0,
                'resolucion' => 0,
            ];
            foreach ($normativas as $normativa) {
                $tipos->total++;
                switch($normativa->id_tipo_normativa){
                    case 1:
                        $tipos->ley++;
                        break;
                    case 2:
                        $tipos->decreto++;
                        break;
                    case 3:
                        $tipos->resolucion++;
                        break;
                }
            }

            return $tipos;
        }

        /**
         * * Get the Normativa from Obras.
         * @param mixed $obras - Obras.
         * @return [type]
         */
        static public function getByObra($obras, $tipo_slug = null){
            if($tipo_slug){
                $normativasToFor = Normativa::where('id_tipo_normativa', '=', $tipo_slug)->with('tipo', 'relaciones', 'enlaces')->get();
            }else{
                $normativasToFor = Normativa::with('tipo', 'relaciones', 'enlaces')->get();
            }
            $normativas = collect([]);
            foreach ($obras as $obra) {
                $relaciones = Relacion::where('id_obra', '=', $obra->id_obra)->get();
                foreach($relaciones as $relacion){
                    foreach ($normativasToFor as $normativa) {
                        if($normativa->id_normativa == $relacion->id_normativa){
                            if(!$normativas->contains($normativa)){
                                $normativas->push($normativa);
                            }
                        }
                    }
                }
            }
            return $normativas;
        }

        public function getListadoFiltros($normativas, $tipo_slug = null){
            if($tipo_slug){
                return [
                    'components.filtros.temas' => TemaController::getAll(null, $normativas, $tipo_slug),
                ];
            }else{
                return [
                    'components.filtros.tipos_normativas' => $this::getAll($normativas),
                    'components.filtros.temas' => TemaController::getAll(null, $normativas),
                ];
            }
        }

        public function getPanelFiltros($normativas){
            return [
                'components.filtros.temas' => TemaController::getAll(null, $normativas),
                'components.filtros.obras' => Obra::get(),
            ];
        }
    }