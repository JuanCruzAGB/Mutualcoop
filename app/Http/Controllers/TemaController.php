<?php
    namespace App\Http\Controllers;

    use App\Models\Nexo;
    use App\Models\Obra;
    use App\Models\Tema;
    use App\Models\Organismo;
    use Auth;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class TemaController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Show the "temas table" panel page.
         * @return [type]
         */
        public function panel(){
            $temas = Tema::with('organismo', 'nexos')->get();

            $organismos = OrganismoController::getAll($temas);

            foreach($temas as $tema){
                $tema->obras = ObraController::getByTema($tema);
            };

            return view('tema.panel', [
                'usuario' => Auth::user(),
                'temas' => $temas,
                'organismos' => $organismos,
                'tabs' => $this->getAdminTabs(),
                'filtros' => $this->getPanelFiltros($temas),
            ]);
        }

        /**
         * * Show the "create Tema" page.
         * @return [type]
         */
        public function showCrear(){
            $obras = Obra::get();
            $organismos = Organismo::get();

            return view('tema.crear', [
                'obras' => $obras,
                'organismos' => $organismos,
                'validation' => (object)[
                    'rules' => Tema::$validation['crear']['rules'],
                    'messages' => Tema::$validation['crear']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Create a Tema.
         * @param Request $request
         * @return [type]
         */
        public function doCrear(Request $request){
            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Tema::$validation['crear']['rules'], Tema::$validation['crear']['messages']['es']);
            if($validator->fails()){
                return redirect('/panel/tema/crear')->withErrors($validator)->withInput();
            }
            
            $input->id_usuario = Auth::id();

            $input->slug = SlugService::createSlug(Tema::class, 'slug', $input->nombre);

            $tema = Tema::create((array) $input);
            
            foreach($input->obras as $obra){
                $inputNexo = new \stdClass();
                $inputNexo->id_tema = $tema->id_tema;
                $inputNexo->id_obra = $obra;
                Nexo::create((array) $inputNexo);
            }
            
            return redirect('/panel/temas')->with('status', [
                'code' => 200,
                'message' => 'Tema subido correctamente.',
            ]);
        }
        
        /**
         * * Show the "edit Tema" page.
         * @param mixed $slug - Tema slug.
         * @return [type]
         */
        public function showEditar($slug){
            $tema = Tema::where('slug', '=', $slug)->get();
            $tema = $tema[0];
            $obras = Obra::get();
            $organismos = Organismo::get();
            $nexos = $tema->nexos;
            $obrasToPush = [];
            foreach($nexos as $nexo){
                $obrasToPush[] = $nexo->id_obra;
            }
            $tema->obras = $obrasToPush;
            
            return view('tema.editar', [
                'tema' => $tema,
                'obras' => $obras,
                'organismos' => $organismos,
                'validation' => (object)[
                    'rules' => Tema::$validation['editar']['rules'],
                    'messages' => Tema::$validation['editar']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Edit a Tema.
         * @param Request $request
         * @param mixed $id_tema - Tema primary key.
         * @return [type]
         */
        public function doEditar(Request $request, $id_tema){
            $tema = Tema::find($id_tema);

            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Tema::$validation['editar']['rules'], Tema::$validation['editar']['messages']['es']);
            if($validator->fails()){
                return redirect("/panel/tema/$tema->slug/editar")->withErrors($validator)->withInput();
            }
            
            $input->id_usuario = Auth::id();

            if($tema->nombre != $input->nombre){
                $input->slug = SlugService::createSlug(Gestion::class, 'slug', $input->nombre);
            }else{
                $input->slug = $tema->slug;
            }

            $tema->update((array) $input);

            foreach($tema->nexos as $nexo){
                $nexo->delete();
            }
            
            foreach($input->obras as $obra){
                $inputNexo = new \stdClass();
                $inputNexo->id_tema = $tema->id_tema;
                $inputNexo->id_obra = $obra;
                Nexo::create((array) $inputNexo);
            }
            
            return redirect('/panel/temas')->with('status', [
                'code' => 200,
                'message' => "El Tema: \"$tema->nombre\" fue editado exitosamente.",
            ]);
        }

        /**
         * * Delete a Tema.
         * @param Request $request
         * @param mixed $id_tema - Tema primary key.
         * @return [type]
         */
        public function doEliminar($id_tema){
            $tema = Tema::find($id_tema);

            foreach($tema->nexos as $nexo){
                $nexo->delete();
            }
                
            $tema->delete();
            
            return redirect('/panel/temas')->with('status', [
                'code' => 200,
                'message' => "El Tema fue eliminado exitosamente.",
            ]);
        }
        
        /**
         * * Get the Normativa Temas.
         * @param mixed $normativa - Normativa.
         * @param mixed $normativas - Normativas.
         * @return [type]
         */
        static function getAll($normativa = null, $normativas = []){
            if($normativa){
                $temas = collect([]);
                foreach($normativa->enlaces as $enlace){
                    $tema = Tema::find($enlace->id_tema);
                    $temas->push($tema);
                }
    
                return $temas;
            }else{
                $temas = collect([]);
                foreach ($normativas as $normativa) {
                    if($normativa->enlaces){
                        foreach ($normativa->enlaces as $enlace) {
                            $push = true;
                            foreach ($temas as $temaFromFor) {
                                if($temaFromFor->id_tema == $enlace->id_tema){
                                    $push = false;
                                }
                            }
                            if($push){
                                $temas->push(Tema::find($enlace->id_tema));
                            }
                        }
                    }
                }
    
                return $temas;
            }
        }

        public function getPanelFiltros($temas){
            return [
                'components.filtros.organismos' => OrganismoController::getAll($temas),
                'components.filtros.obras' => Obra::get(),
            ];
        }
    }