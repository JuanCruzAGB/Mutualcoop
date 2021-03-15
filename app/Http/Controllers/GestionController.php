<?php
    namespace App\Http\Controllers;

    use App\Models\Categoria;
    use App\Models\Gestion;
    use App\Models\Obra;
    use App\Models\Tipo;
    use App\Models\Vinculo;
    use App\Models\Conexion;
    use Auth;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;
    use Intervention\Image\ImageManagerStatic as Image;
    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Facades\Validator;
    use Storage;

    class GestionController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Show the "manageables list" page.
         * @return [type]
         */
        public function listado($tipo_slug = null){
            $usuario = Auth::user();
            $obras = ObraController::getByUsuario($usuario);
            if($tipo_slug){
                $tipo = TipoController::getOne(null, $tipo_slug);
                $gestiones = $this::getByObra($obras, $tipo->id_tipo);
            }else{
                $gestiones = $this::getByObra($obras);
            }

            $categorias = CategoriaController::getAll($gestiones);

            foreach($gestiones as $gestion){
                $gestion->obras = ObraController::getByGestion($gestion);
            };

            if (Auth::user()->id_nivel == 1) {
                $tabs = $this->getSubsTabs();
            } else {
                $tabs = $this->getAdminTabs();
            }

            if ($tipo_slug) {
                $current = ucfirst($tipo_slug);
            } else {
                $current = 'undefined';
            }

            return view('gestion.listado', [
                'usuario' => $usuario,
                'gestiones' => $gestiones,
                'categorias' => $categorias,
                'current' => $current,
                'tabs' => $tabs,
                'filtros' => $this->getListadoFiltros($gestiones, $tipo_slug),
            ]);
        }

        /**
         * * Show the "manageables table" panel page.
         * @return [type]
         */
        public function panel(){
            $gestiones = Gestion::with('tipo', 'vinculos', 'categoria')->get();

            $tipos = $this::getAll($gestiones);
            $categorias = CategoriaController::getAll($gestiones);

            foreach($gestiones as $gestion){
                $gestion->obras = ObraController::getByGestion($gestion);
                $gestion->tipo_gestion = TipoController::getOne($gestion->id_tipo_gestion);
            };

            return view('gestion.panel', [
                'usuario' => Auth::user(),
                'gestiones' => $gestiones,
                'tipos' => $tipos,
                'categorias' => $categorias,
                'tabs' => $this->getAdminTabs(),
                'filtros' => $this->getPanelFiltros($gestiones),
            ]);
        }

        /**
         * * Show the "create Gestion" page.
         * @return [type]
         */
        public function showCrear(Request $request){
            $obras = Obra::get();
            $tipos = Tipo::where('id_tipo', '>', '3')->with('conexiones')->get();
            $categorias = Categoria::with('uniones')->get();

            return view('gestion.crear', [
                'tipos' => $tipos,
                'obras' => $obras,
                'categorias' => $categorias,
                'validation' => (object)[
                    'rules' => Gestion::$validation['crear']['rules'],
                    'messages' => Gestion::$validation['crear']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Create a Gestion.
         * @param Request $request
         * @return [type]
         */
        public function doCrear(Request $request){
            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Gestion::$validation['crear']['rules'], Gestion::$validation['crear']['messages']['es']);
            if($validator->fails()){
                return redirect('/panel/gestion/crear')->withErrors($validator)->withInput();
            }

            $filepath = $request->file('archivo')->hashName('gestiones');
            
            if($request->hasFile('archivo')){
                switch($request->archivo->extension()){
                    case 'pdf':
                        //
                        break;
                    default:
                        $file = Image::make($request->file('archivo'))
                                ->resize(500, 400, function($constrait){
                                    $constrait->aspectRatio();
                                    $constrait->upsize();
                                });
                        break;
                }
            }
                                
            Storage::put($filepath, (string) $file->encode());
            
            $input->archivo = $filepath;
            
            $input->id_usuario = Auth::id();

            $input->slug = SlugService::createSlug(Gestion::class, 'slug', $input->titulo);
            
            $gestion = Gestion::create((array) $input);
            
            foreach($input->obras as $obra){
                $inputVinculo = new \stdClass();
                $inputVinculo->id_gestion = $gestion->id_gestion;
                $inputVinculo->id_obra = $obra;
                Vinculo::create((array) $inputVinculo);
            }
            
            return redirect('/panel/gestiones')->with('status', [
                'code' => 200,
                'message' => 'Gestión subida correctamente.',
            ]);
        }
        
        /**
         * * Show the "edit Gestion" page.
         * @param mixed $slug - Gestion slug.
         * @return [type]
         */
        public function showEditar($slug){
            $obras = Obra::get();
            $gestion = Gestion::where('slug', '=', $slug)->get();
            $gestion = $gestion[0];
            $tipos = Tipo::where('id_tipo', '>', '3')->with('conexiones')->get();
            $categorias = Categoria::with('uniones')->get();
            $vinculos = $gestion->vinculos;
            $obrasToPush = [];
            foreach($vinculos as $vinculo){
                $obrasToPush[] = $vinculo->id_obra;
            }
            $gestion->obras = $obrasToPush;

            return view('gestion.editar', [
                'gestion' => $gestion,
                'obras' => $obras,
                'tipos' => $tipos,
                'categorias' => $categorias,
                'validation' => (object)[
                    'rules' => Gestion::$validation['editar']['rules'],
                    'messages' => Gestion::$validation['editar']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Edit a Gestion.
         * @param Request $request
         * @param mixed $id_gestion - Gestion primary key.
         * @return [type]
         */
        public function doEditar(Request $request, $id_gestion){
            $gestion = Gestion::find($id_gestion);

            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Gestion::$validation['editar']['rules'], Gestion::$validation['editar']['messages']['es']);
            if($validator->fails()){
                return redirect("/panel/gestion/$gestion->slug/editar")->withErrors($validator)->withInput();
            }
            
            if($request->hasFile('archivo')){
                $archivo_actual = $gestion->archivo;

                $filepath = $request->file('archivo')->hashName('gestiones');
                
                switch($request->archivo->extension()){
                    case 'pdf':
                        //
                        break;
                    default:
                        $file = Image::make($request->file('archivo'))
                                ->resize(500, 400, function($constrait){
                                    $constrait->aspectRatio();
                                    $constrait->upsize();
                                });
                        break;
                }
                                
                Storage::put($filepath, (string) $file->encode());
                
                $input->archivo = $filepath;
            }else{
                $input->archivo = $gestion->archivo;
            }
            
            $input->id_usuario = Auth::id();

            if($gestion->titulo != $input->titulo){
                $input->slug = SlugService::createSlug(Gestion::class, 'slug', $input->titulo);
            }else{
                $input->slug = $gestion->slug;
            }

            if(!isset($input->id_categoria)){
                $input->id_categoria = null;
            }
            
            $gestion->update((array) $input);
            
            if(isset($archivo_actual) && !empty($archivo_actual)){
                Storage::delete($archivo_actual);
            }

            foreach($gestion->vinculos as $vinculo){
                $vinculo->delete();
            }
            
            foreach($input->obras as $obra){
                $inputVinculo = new \stdClass();
                $inputVinculo->id_gestion = $gestion->id_gestion;
                $inputVinculo->id_obra = $obra;
                Vinculo::create((array) $inputVinculo);
            }
            
            return redirect('/panel/gestiones')->with('status', [
                'code' => 200,
                'message' => "La Gestión: \"$gestion->titulo\" fue editada exitosamente.",
            ]);
        }

        /**
         * * Delete a Gestion.
         * @param Request $request
         * @return [type]
         */
        public function doEliminar($id_gestion){
            $gestion = Gestion::find($id_gestion);

            if(isset($gestion->archivo) && !empty($gestion->archivo)) {
                Storage::delete($gestion->archivo);
            }

            foreach($gestion->vinculos as $vinculo){
                $vinculo->delete();
            }
                
            $gestion->delete();
            
            return redirect('/panel/gestiones')->with('status', [
                'code' => 200,
                'message' => "La Gestión fue eliminada exitosamente.",
            ]);
        }

        /**
         * * Get the count of Gestiones tipos.
         * @param mixed $gestiones - Gestiones.
         * @return [type]
         */
        static function getAll($gestiones){
            $tipos = (object) [
                'total' => 0,
                'administrativo_contable' => 0,
                'impositivo' => 0,
                'previsional' => 0,
                'recursos' => 0,
                'analisis_reglamentacion' => 0,
                'informacion_complementaria' => 0,
                'jurisprudencia' => 0,
            ];
            foreach ($gestiones as $gestion) {
                $tipos->total++;
                switch($gestion->id_tipo_gestion){
                    case 4:
                        $tipos->administrativo_contable++;
                        break;
                    case 5:
                        $tipos->impositivo++;
                        break;
                    case 6:
                        $tipos->previsional++;
                        break;
                    case 7:
                        $tipos->recursos++;
                        break;
                    case 8:
                        $tipos->analisis_reglamentacion++;
                        break;
                    case 9:
                        $tipos->informacion_complementaria++;
                        break;
                    case 10:
                        $tipos->jurisprudencia++;
                        break;
                }
            }

            return $tipos;
        }

        /**
         * * Get the count of Categorias tipos.
         * @param mixed $categorias - Categorias.
         * @return [type]
         */
        static function getAllByCategorias($categorias){
            $tipos = (object) [
                'total' => 0,
                'administrativo_contable' => 0,
                'impositivo' => 0,
                'previsional' => 0,
                'recursos' => 0,
                'analisis_reglamentacion' => 0,
                'informacion_complementaria' => 0,
                'jurisprudencia' => 0,
            ];
            foreach ($categorias as $categoria) {
                $tipos->total++;
                switch($categoria->id_tipo_gestion){
                    case 4:
                        $tipos->administrativo_contable++;
                        break;
                    case 5:
                        $tipos->impositivo++;
                        break;
                    case 6:
                        $tipos->previsional++;
                        break;
                    case 7:
                        $tipos->recursos++;
                        break;
                    case 8:
                        $tipos->analisis_reglamentacion++;
                        break;
                    case 9:
                        $tipos->informacion_complementaria++;
                        break;
                    case 10:
                        $tipos->jurisprudencia++;
                        break;
                }
            }

            return $tipos;
        }

        /**
         * * Get the Gestion from Obras.
         * @param mixed $obras - Obras.
         * @return [type]
         */
        static public function getByObra($obras, $id_tipo_gestion = null){
            if($id_tipo_gestion){
                $gestionesToFor = Gestion::where('id_tipo_gestion', '=', $id_tipo_gestion)->with('tipo', 'vinculos', 'categoria')->get();
            }else{
                $gestionesToFor = Gestion::with('tipo', 'vinculos', 'categoria')->get();
            }
            $gestiones = collect([]);
            foreach ($obras as $obra) {
                $vinculos = Vinculo::where('id_obra', '=', $obra->id_obra)->get();
                foreach($vinculos as $vinculo){
                    foreach ($gestionesToFor as $gestion) {
                        if($gestion->id_gestion == $vinculo->id_gestion){
                            if(!$gestiones->contains($gestion)){
                                $gestiones->push($gestion);
                            }
                        }
                    }
                }
            }
            return $gestiones;
        }

        public function getListadoFiltros($gestiones, $tipo_slug = null){
            if($tipo_slug){
                return [
                    'components.filtros.categorias' => CategoriaController::getAll($gestiones),
                ];
            }else{
                return [
                    'components.filtros.tipos_gestiones' => $this::getAll($gestiones),
                    'components.filtros.categorias' => CategoriaController::getAll($gestiones),
                ];
            }
        }

        public function getPanelFiltros($gestiones){
            return [
                'components.filtros.categorias' => CategoriaController::getAll($gestiones),
                'components.filtros.obras' => Obra::get(),
            ];
        }
    }