<?php
    namespace App\Http\Controllers;

    use App\Models\Categoria;
    use App\Models\Gestion;
    use App\Models\Obra;
    use App\Models\Tipo;
    use App\Models\Union;
    use App\User;
    use Auth;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class CategoriaController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Show the "users table" panel page.
         * @return [type]
         */
        public function panel(){
            $categorias = Categoria::with('tipo', 'uniones')->get();

            $tipos = GestionController::getAllByCategorias($categorias);

            foreach($categorias as $categoria){
                $categoria->obras = ObraController::getByCategoria($categoria);
                $categoria->tipo_gestion = TipoController::getOne($categoria->id_tipo_gestion);
            };

            return view('categoria.panel', [
                'usuario' => Auth::user(),
                'categorias' => $categorias,
                'tipos' => $tipos,
                'tabs' => $this->getAdminTabs(),
                'filtros' => $this->getPanelFiltros($categorias),
            ]);
        }

        /**
         * * Show the "create Categoria" page.
         * @return [type]
         */
        public function showCrear(Request $request){
            $obras = Obra::get();
            $tipos = Tipo::where('id_tipo', '>=', '4')->get();

            return view('categoria.crear', [
                'obras' => $obras,
                'tipos' => $tipos,
                'validation' => (object)[
                    'rules' => Categoria::$validation['crear']['rules'],
                    'messages' => Categoria::$validation['crear']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Create a Categoria.
         * @param Request $request
         * @return [type]
         */
        public function doCrear(Request $request){
            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Categoria::$validation['crear']['rules'], Categoria::$validation['crear']['messages']['es']);
            if($validator->fails()){
                return redirect('/panel/categoria/crear')->withErrors($validator)->withInput();
            }
            
            $input->id_usuario = Auth::id();

            $input->slug = SlugService::createSlug(Categoria::class, 'slug', $input->nombre);

            $categoria = Categoria::create((array) $input);
            
            foreach($input->obras as $obra){
                $inputUnion = new \stdClass();
                $inputUnion->id_categoria = $categoria->id_categoria;
                $inputUnion->id_obra = $obra;
                Union::create((array) $inputUnion);
            }
            
            return redirect('/panel/categorias')->with('status', [
                'code' => 200,
                'message' => 'Categoría subida correctamente.',
            ]);
        }
        
        /**
         * * Show the "edit Categoria" page.
         * @param mixed $slug - Categoria slug.
         * @return [type]
         */
        public function showEditar($slug){
            $categoria = Categoria::where('slug', '=', $slug)->get();
            $categoria = $categoria[0];
            $obras = Obra::get();
            $tipos = Tipo::where('id_tipo', '>=', '4')->get();
            $uniones = $categoria->uniones;
            $obrasToPush = [];
            foreach($uniones as $union){
                $obrasToPush[] = $union->id_obra;
            }
            $categoria->obras = $obrasToPush;
            
            return view('categoria.editar', [
                'categoria' => $categoria,
                'obras' => $obras,
                'tipos' => $tipos,
                'validation' => (object)[
                    'rules' => Categoria::$validation['editar']['rules'],
                    'messages' => Categoria::$validation['editar']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Edit a Catgegoria.
         * @param Request $request
         * @param mixed $id_categoria - Catgegoria primary key.
         * @return [type]
         */
        public function doEditar(Request $request, $id_categoria){
            $categoria = Categoria::find($id_categoria);

            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Categoria::$validation['editar']['rules'], Categoria::$validation['editar']['messages']['es']);
            if($validator->fails()){
                return redirect("/panel/categoria/$categoria->slug/editar")->withErrors($validator)->withInput();
            }
            
            $input->id_usuario = Auth::id();

            if($categoria->nombre != $input->nombre){
                $input->slug = SlugService::createSlug(Gestion::class, 'slug', $input->nombre);
            }else{
                $input->slug = $categoria->slug;
            }

            $categoria->update((array) $input);

            foreach($categoria->uniones as $union){
                $union->delete();
            }
            
            foreach($input->obras as $obra){
                $inputUnion = new \stdClass();
                $inputUnion->id_categoria = $categoria->id_categoria;
                $inputUnion->id_obra = $obra;
                Union::create((array) $inputUnion);
            }
            
            return redirect('/panel/categorias')->with('status', [
                'code' => 200,
                'message' => "La Categoría: \"$categoria->nombre\" fue editada exitosamente.",
            ]);
        }

        /**
         * * Delete a Categoria.
         * @param Request $request
         * @param mixed $id_categoria - Categoria primary key.
         * @return [type]
         */
        public function doEliminar($id_categoria){
            $categoria = Categoria::find($id_categoria);

            foreach($categoria->uniones as $union){
                $union->delete();
            }
                
            $categoria->delete();
            
            return redirect('/panel/categorias')->with('status', [
                'code' => 200,
                'message' => "La Categoria fue eliminada exitosamente.",
            ]);
        }

        /**
         * * Get the count of Gestion Categorias.
         * @param mixed $gestiones - Gestion.
         * @return [type]
         */
        static function getAll($gestiones){
            $categorias = [
                (object)['camelName' =>'Total' ,'nombre' => 'total', 'id_categoria' => 0, 'value' => 0],
            ];
            foreach ($gestiones as $gestion) {
                if ($gestion->categoria) {
                    $categorias[0]->value++;
                    $push = true;
                    foreach ($categorias as $categoriaFromFor) {
                        if($categoriaFromFor->id_categoria == $gestion->categoria->id_categoria){
                            $push = false;
                            $category = $categoriaFromFor;
                        }
                    }
                    if($push){
                        $gestion->categoria->camelName = ucfirst($gestion->categoria->nombre);
                        $gestion->categoria->value = 1;
                        $categorias[] = $gestion->categoria;
                    } else {
                        $category->value++;
                    }
                }
            }

            return $categorias;
        }

        public function getPanelFiltros($categorias){
            return [
                'components.filtros.tipos_gestiones' => GestionController::getAllByCategorias($categorias),
                'components.filtros.obras' => Obra::get(),
            ];
        }
    }