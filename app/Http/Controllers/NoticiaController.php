<?php
    namespace App\Http\Controllers;
    
    use App\Models\Noticia;
    use Auth;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Intervention\Image\ImageManagerStatic as Image;
    use Storage;

    class NoticiaController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Show the "news table" panel page.
         * @return [type]
         */
        public function panel(){
            $noticias = Noticia::get();

            return view('noticia.panel', [
                'usuario' => Auth::user(),
                'noticias' => $noticias,
                'tabs' => $this->getAdminTabs(),
                'filtros' => $this->getPanelFiltros(),
            ]);
        }

        public function listado(){
            $noticias = Noticia::orderBy('updated_at', 'DESC')->get();

            foreach($noticias as $noticia){
                $noticia->minified = (object) [
                    'descripcion' => $this->minific($noticia->descripcion, 100),
                ];
                $noticia->fecha = $this->createDate($this->idiom, $noticia->fecha);
            }
            
            return view('noticia.listado', [
                'noticias' => $noticias,
            ]);
        }

        /**
         * * Show the "Noticia details" page.
         * @param mixed $slug - Noticia slug.
         * @return [type]
         */
        public function detalles($slug){
            $noticia = Noticia::where('slug', '=', $slug)->get();
            $noticia = $noticia[0];
            $noticia->fecha = $this->createDate($this->idiom, $noticia->fecha);

            return view('noticia.detalles', [
                'noticia' => $noticia
            ]);
        }

        /**
         * * Show the "create Noticia" page.
         * @return [type]
         */
        public function showCrear(){
            return view('noticia.crear', [
                'validation' => (object)[
                    'rules' => Noticia::$validation['crear']['rules'],
                    'messages' => Noticia::$validation['crear']['messages']['es'],
                ],
            ]);
        }
        
        /**
         * * Create the Noticia.
         * @param Request $request
         * @return [type]
         */
        public function doCrear(Request $request){
            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Noticia::$validation['crear']['rules'], Noticia::$validation['crear']['messages']['es']);
            if($validator->fails()){
                return redirect('/panel/noticia/crear')->withErrors($validator)->withInput();
            }
            
            $filepath = $request->file('archivo')->hashName('noticias');
            
            $file = Image::make($request->file('archivo'))
                    ->resize(1000, 400, function($constrait){
                        $constrait->aspectRatio();
                        $constrait->upsize();
                    });
                    
            Storage::put($filepath, (string) $file->encode());
            
            $input->archivo = $filepath;
            
            $input->id_usuario = Auth::id();

            $input->slug = SlugService::createSlug(Noticia::class, 'slug', $input->titulo);

            Noticia::create((array) $input);
            
            return redirect('/panel/noticias')->with('status', [
                'code' => 200,
                'message' => 'Noticia subida correctamente.',
            ]);
        }
        
        /**
         * * Show the "creaeditte Noticia" page.
         * @param mixed $slug - Noticia slug.
         * @return [type]
         */
        public function showEditar($slug){
            $noticia = Noticia::where('slug', '=', $slug)->get();
            $noticia = $noticia[0];

            return view('noticia.editar', [
                'noticia' => $noticia,
                'validation' => (object)[
                    'rules' => Noticia::$validation['editar']['rules'],
                    'messages' => Noticia::$validation['editar']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Edit the Noticia.
         * @param Request $request
         * @param mixed $id_noticia - Noticia primary key.
         * @return [type]
         */
        public function doEditar(Request $request, $id_noticia){
            $noticia = Noticia::find($id_noticia);

            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Noticia::$validation['editar']['rules'], Noticia::$validation['editar']['messages']['es']);
            if($validator->fails()){
                return redirect("/panel/noticia/$noticia->slug/editar")->withErrors($validator)->withInput();
            }
            
            if($request->hasFile('archivo')){
                $archivo_actual = $noticia->imagen;
                
                $filepath = $request->file('archivo')->hashName('eventos');
                
                $file = Image::make($request->file('archivo'))
                        ->resize(1000, 400, function($constrait){
                            $constrait->aspectRatio();
                            $constrait->upsize();
                        });
                        
                Storage::put($filepath, (string) $file->encode());
                
                $input->archivo = $filepath;
            }else{
                $input->archivo = $noticia->archivo;
            }
            
            $input->id_usuario = Auth::id();

            if($noticia->titulo != $input->titulo){
                $input->slug = SlugService::createSlug(Noticia::class, 'slug', $input->titulo);
            }else{
                $input->slug = $noticia->slug;
            }
            
            $noticia->update((array) $input);
            
            if(isset($archivo_actual) && !empty($archivo_actual)) {
                Storage::delete($archivo_actual);
            }
            
            return redirect('/panel/noticias')->with('status', [
                'code' => 200,
                'message' => "La Noticia: \"$noticia->titulo\" fue editada exitosamente.",
            ]);
        }

        /**
         * * Delete the Noticia.
         * @param mixed $id_noticia - Noticia primary key.
         * @return [type]
         */
        public function doEliminar($id_noticia){
            $noticia = Noticia::find($id_noticia);

            if(isset($noticia->archivo) && !empty($noticia->archivo)){
                Storage::delete($noticia->archivo);
            }
                
            $noticia->delete();
            
            return redirect('/panel/noticias')->with('status', [
                'code' => 200,
                'message' => "La Noticia fue eliminada exitosamente.",
            ]);
        }

        public function getPanelFiltros(){
            return [
                //
            ];
        }
    }