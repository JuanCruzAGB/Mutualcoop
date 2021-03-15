<?php
    namespace App\Http\Controllers;

    use App\Models\Pregunta;
    use Auth;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class PreguntaController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Show the "faqs table" panel page.
         * @return [type]
         */
        public function panel(){
            $preguntas = Pregunta::get();

            return view('pregunta.panel', [
                'usuario' => Auth::user(),
                'preguntas' => $preguntas,
                'tabs' => $this->getAdminTabs(),
                'filtros' => $this->getPanelFiltros(),
            ]);
        }

        /**
         * * Show the "create Pregunta" page.
         * @return [type]
         */
        public function showCrear(){
            return view('pregunta.crear',[
                'validation' => (object)[
                    'rules' => Pregunta::$validation['crear']['rules'],
                    'messages' => Pregunta::$validation['crear']['messages']['es'],
                ],
            ]);
        }
        
        /**
         * * Create a Pregunta.
         * @param Request $request
         * @return [type]
         */
        public function doCrear(Request $request){
            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Pregunta::$validation['crear']['rules'], Pregunta::$validation['crear']['messages']['es']);
            if($validator->fails()){
                return redirect('/panel/pregunta/crear')->withErrors($validator)->withInput();
            }

            $input->slug = SlugService::createSlug(Pregunta::class, 'slug', $input->pregunta);

            if(isset($input->privado)){
                $input->privado = true;
            }else{
                $input->privado = false;
            }

            $input->id_usuario = Auth::id();
            
            $pregunta = Pregunta::create((array) $input);
            
            return redirect('/panel/preguntas')->with('status', [
                'code' => 200,
                'message' => 'Pregunta creada correctamente.',
            ]);
        }

        /**
         * * Show the "edit Pregunta" page.
         * @param mixed $slug - Pregunta slug.
         * @return [type]
         */
        public function showEditar($slug){
            $pregunta = Pregunta::where('slug', '=', $slug)->get();
            $pregunta = $pregunta[0];

            return view('pregunta.editar', [
                'pregunta' => $pregunta,
                'validation' => (object)[
                    'rules' => Pregunta::$validation['editar']['rules'],
                    'messages' => Pregunta::$validation['editar']['messages']['es'],
                ],
            ]);
        }
        
        /**
         * * Edit a Pregunta.
         * @param Request $request
         * @param mixed $id_pregunta - Pregunta primary key.
         * @return [type]
         */
        public function doEditar(Request $request, $id_pregunta){
            $pregunta = Pregunta::find($id_pregunta);

            $input = (object) $request->all();
            $validator = Validator::make($request->all(), $this->replaceString(Pregunta::$validation['editar']['rules'], "({[a-z_]*})", $pregunta->id_pregunta), Pregunta::$validation['editar']['messages']['es']);
            if($validator->fails()){
                return redirect("/panel/pregunta/$pregunta->slug/editar")->withErrors($validator)->withInput();
            }

            if($pregunta->pregunta != $input->pregunta){
                $input->slug = SlugService::createSlug(Pregunta::class, 'slug', $input->pregunta);
            }else{
                $input->slug = $pregunta->slug;
            }

            if(isset($input->privado)){
                $input->privado = true;
            }else{
                $input->privado = false;
            }

            $input->id_usuario = Auth::id();
            
            $pregunta->update((array) $input);
            
            return redirect('/panel/preguntas')->with('status', [
                'code' => 200,
                'message' => "La Pregunta: \"$pregunta->pregunta\" fue editada exitosamente.",
            ]);
        }

        /**
         * * Delete a Pregunta.
         * @param mixed $id_pregunta - Pregunta primary key.
         * @return [type]
         */
        public function doEliminar($id_pregunta){
            $pregunta = Pregunta::find($id_pregunta);
                
            $pregunta->delete();
            
            return redirect('/panel/preguntas')->with('status', [
                'code' => 200,
                'message' => "La Pregunta fue eliminada exitosamente.",
            ]);
        }

        public function getPanelFiltros(){
            return [
                //
            ];
        }
    }