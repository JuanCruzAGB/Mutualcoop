<?php
    namespace App\Http\Controllers;

    use App\Models\Educacion;
    use Auth;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\File;
    use Intervention\Image\ImageManagerStatic as Image;
    use Illuminate\Support\Facades\Validator;
    use Storage;

    class EducacionController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Show the "educaciones list" page.
         * @return [type]
         */
        public function listado(){
            $educaciones = Educacion::get();

            if (Auth::user()->id_nivel == 1) {
                $tabs = $this->getSubsTabs();
            } else {
                $tabs = $this->getAdminTabs();
            }

            return view('educacion.listado', [
                'usuario' => Auth::user(),
                'educaciones' => $educaciones,
                'tabs' => $tabs,
                'filtros' => $this->getFiltros(),
            ]);
        }

        /**
         * * Show the "educaciones table" panel page.
         * @return [type]
         */
        public function panel(){
            $educaciones = Educacion::get();

            return view('educacion.panel', [
                'usuario' => Auth::user(),
                'educaciones' => $educaciones,
                'tabs' => $this->getAdminTabs(),
                'filtros' => $this->getFiltros(),
            ]);
        }

        /**
         * * Show the "create Educacion" page.
         * @return [type]
         */
        public function showCrear(){
            return view('educacion.crear', [
                'validation' => (object)[
                    'rules' => Educacion::$validation['crear']['rules'],
                    'messages' => Educacion::$validation['crear']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Create a Educacion.
         * @param Request $request
         * @return [type]
         */
        public function doCrear(Request $request){
            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Educacion::$validation['crear']['rules'], Educacion::$validation['crear']['messages']['es']);
            if($validator->fails()){
                return redirect('/panel/educacion/crear')->withErrors($validator)->withInput();
            }

            $filepath = $request->file('archivo')->hashName('educaciones');
            
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
            
            $input->id_usuario = Auth::id();

            $input->slug = SlugService::createSlug(Educacion::class, 'slug', $input->titulo);
            
            Educacion::create((array) $input);
            
            return redirect('/panel/notas-de-interes')->with('status', [
                'code' => 200,
                'message' => 'Educación o Capacitación subida correctamente.',
            ]);
        }
        
        /**
         * * Show the "edit Educacion" page.
         * @param mixed $slug - Educacion slug.
         * @return [type]
         */
        public function showEditar($slug){
            $educacion = Educacion::where('slug', '=', $slug)->get();
            $educacion = $educacion[0];

            return view('educacion.editar', [
                'educacion' => $educacion,
                'validation' => (object)[
                    'rules' => Educacion::$validation['editar']['rules'],
                    'messages' => Educacion::$validation['editar']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Edit a Educacion.
         * @param Request $request
         * @param mixed $id_educacion - Educacion primary key.
         * @return [type]
         */
        public function doEditar(Request $request, $id_educacion){
            $educacion = Educacion::find($id_educacion);

            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Educacion::$validation['editar']['rules'], Educacion::$validation['editar']['messages']['es']);
            if($validator->fails()){
                return redirect("/panel/educacion/$educacion->slug/editar")->withErrors($validator)->withInput();
            }
            
            if($request->hasFile('archivo')){
                $archivo_actual = $educacion->archivo;

                $filepath = $request->file('archivo')->hashName('educaciones');
                
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
                $input->archivo = $educacion->archivo;
            }
            
            $input->id_usuario = Auth::id();

            if($educacion->titulo != $input->titulo){
                $input->slug = SlugService::createSlug(Educacion::class, 'slug', $input->titulo);
            }else{
                $input->slug = $educacion->slug;
            }
            
            $educacion->update((array) $input);
            
            if(isset($archivo_actual) && !empty($archivo_actual)){
                Storage::delete($archivo_actual);
            }
            
            return redirect('/panel/notas-de-interes')->with('status', [
                'code' => 200,
                'message' => "La Educación o Capacitación: \"$educacion->titulo\" fue editada exitosamente.",
            ]);
        }

        /**
         * * Delete a Educacion.
         * @param Request $request
         * @param mixed $id_educacion - Educacion primary key.
         * @return [type]
         */
        public function doEliminar($id_educacion){
            $educacion = Educacion::find($id_educacion);

            if(isset($educacion->archivo) && !empty($educacion->archivo)){
                Storage::delete($educacion->archivo);
            }
                
            $educacion->delete();
            
            return redirect('/panel/notas-de-interes')->with('status', [
                'code' => 200,
                'message' => "La Educación o Capacitación fue eliminada exitosamente.",
            ]);
        }

        public function getFiltros(){
            return [
                //
            ];
        }
    }