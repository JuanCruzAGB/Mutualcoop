<?php
    namespace App\Http\Controllers;

    use App\Models\Evento;
    use Auth;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;
    use Intervention\Image\ImageManagerStatic as Image;
    use Illuminate\Support\Facades\Validator;
    use Storage;

    class EventoController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Show the "event table" panel page.
         * @return [type]
         */
        public function panel(){
            $eventos = Evento::orderBy('fecha', 'desc')->get();

            return view('evento.panel', [
                'usuario' => Auth::user(),
                'eventos' => $eventos,
                'tabs' => $this->getAdminTabs(),
                'filtros' => $this->getPanelFiltros(),
            ]);
        }

        /**
         * * Show the "create Evento" page.
         * @return [type]
         */
        public function showCrear(){
            return view('evento.crear', [
                'validation' => (object)[
                    'rules' => Evento::$validation['crear']['rules'],
                    'messages' => Evento::$validation['crear']['messages']['es'],
                ],
            ]);
        }
        
        /**
         * * Create an Evento.
         * @param $request Request
         * @return [type]
         */
        public function doCrear(Request $request){
            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Evento::$validation['crear']['rules'], Evento::$validation['crear']['messages']['es']);
            if($validator->fails()){
                return redirect('/panel/evento/crear')->withErrors($validator)->withInput();
            }

            if(isset($input->privado)){
                $input->privado = true;
            }else{
                $input->privado = false;
            }
            
            $filepath = $request->file('archivo')->hashName('eventos');

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

            $input->slug = SlugService::createSlug(Evento::class, 'slug', $input->titulo);
            
            Evento::create((array) $input);
            
            return redirect('/panel/eventos')->with('status', [
                'code' => 200,
                'message' => 'Evento subido correctamente.',
            ]);
        }
        
        /**
         * * Show the "edit Evento" page.
         * @param mixed $slug - Evento slug.
         * @return [type]
         */
        public function showEditar($slug){
            $evento = Evento::where('slug', '=', $slug)->get();
            $evento = $evento[0];

            return view('evento.editar', [
                'evento' => $evento,
                'validation' => (object)[
                    'rules' => Evento::$validation['editar']['rules'],
                    'messages' => Evento::$validation['editar']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Edit an Evento.
         * @param Request $request
         * @param mixed $id_evento - Evento primary.
         * @return [type]
         */
        public function doEditar(Request $request, $id_evento){
            $evento = Evento::find($id_evento);

            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Evento::$validation['editar']['rules'], Evento::$validation['editar']['messages']['es']);
            if($validator->fails()){
                return redirect("/panel/evento/$evento->Slug/editar")->withErrors($validator)->withInput();
            }

            if(isset($input->privado)){
                $input->privado = true;
            }else{
                $input->privado = false;
            }

            if(!isset($input->fecha)){
                $input->fecha = $evento->fecha;
            }
            
            if($request->hasFile('archivo')){
                $archivo_actual = $evento->archivo;
                $filepath = $request->file('archivo')->hashName('eventos');
                
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
                $input->archivo = $evento->archivo;
            }
            
            $input->id_usuario = Auth::id();

            if($evento->titulo != $input->titulo){
                $input->slug = SlugService::createSlug(Evento::class, 'slug', $input->titulo);
            }else{
                $input->slug = $evento->slug;
            }
            
            $evento->update((array) $input);
            
            if(isset($archivo_actual) && !empty($archivo_actual)){
                Storage::delete($archivo_actual);
            }
            
            return redirect('/panel/eventos')->with('status', [
                'code' => 200,
                'message' => "El Evento: \"$evento->titulo\" fue editado exitosamente.",
            ]);
        }

        /**
         * * Delete an Evento.
         * @param mixed $id_evento - Evento prymary key.
         * @return [type]
         */
        public function doEliminar($id_evento){
            $evento = Evento::find($id_evento);

            if(isset($evento->archivo) && !empty($evento->archivo)) {
                Storage::delete($evento->archivo);
            }
                
            $evento->delete();
            
            return redirect('/panel/eventos')->with('status', [
                'code' => 200,
                'message' => "El Evento fue eliminado exitosamente.",
            ]);
        }

        public function getPanelFiltros(){
            return [
                //
            ];
        }
    }