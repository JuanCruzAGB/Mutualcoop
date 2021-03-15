<?php
    namespace App\Http\Controllers;

    use App\Models\Obra;
    use App\Models\Suscripcion;
    use App\User;
    use Auth;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class UsuarioController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Show the "users table" panel page.
         * @return [type]
         */
        public function panel(){
            $usuarios = User::with('suscripciones', 'nivel')->get();

            $niveles = NivelController::getAll($usuarios);
            $suscripciones = SuscripcionController::getAll($usuarios);

            foreach($usuarios as $usuario){
                $usuario->obras = ObraController::getByUsuario($usuario);
                $usuario->estado  = $this->getEstado($usuario);
                $usuario->suscripcion  = SuscripcionController::getOne($usuario);
            };

            return view('usuario.panel', [
                'usuario' => Auth::user(),
                'usuarios' => $usuarios,
                'niveles' => $niveles,
                'suscripciones' => $suscripciones,
                'tabs' => $this->getAdminTabs(),
                'filtros' => $this->getPanelFiltros(),
            ]);
        }

        /**
         * * Show the "create User" page.
         * @return [type]
         */
        public function showCrear(){
            $obras = Obra::get();
            $id_suscriptor = User::orderBy('id_suscriptor', 'DESC')->get();
            $id_suscriptor = $id_suscriptor[0]->id_suscriptor + 1;

            return view('usuario.crear', [
                'id_suscriptor' => $id_suscriptor,
                'obras' => $obras,
                'validation' => (object)[
                    'rules' => User::$validation['crear']['general']['rules'],
                    'messages' => User::$validation['crear']['general']['messages']['es'],
                ],
            ]);
        }
        
        /**
         * * Create a User.
         * @param Request $request
         * @return [type]
         */
        public function doCrear(Request $request){
            $input = (object) $request->all();
            $validator = Validator::make($request->all(), User::$validation['crear']['general']['rules'], User::$validation['crear']['general']['messages']['es']);
            if($validator->fails()){
                return redirect('/panel/usuario/crear')->withErrors($validator)->withInput();
            }

            if($input->id_nivel == 1){
                $validator = Validator::make($request->all(), User::$validation['crear']['suscriptor']['rules'], User::$validation['crear']['suscriptor']['messages']['es']);
                if($validator->fails()){
                    return redirect('/panel/usuario/crear')->withErrors($validator)->withInput();
                }
            }else{
                $input->estado = 3;
            }

            if(isset($input->correo_facturacion) || isset($input->correo_informacion) || isset($input->whatsapp) || isset($input->alta) || isset($input->baja) || isset($input->estado) || isset($input->detalles)){
                $validator = Validator::make($request->all(), User::$validation['crear']['avanzado']['rules'], User::$validation['crear']['avanzado']['messages']['es']);
                if($validator->fails()){
                    return redirect('/panel/usuario/crear')->withErrors($validator)->withInput();
                }
            }
    
            $input->clave = \Hash::make($input->clave);

            $input->slug = SlugService::createSlug(User::class, 'slug', $input->nombre);
            
            $usuario = User::create((array) $input);

            if(!$input->alta){
                $input->alta = date('Y-m-d', strtotime($usuario->updated_at));
                $usuario->update((array) $input);
            }

            if($input->id_nivel == 1){
                foreach($input->obras as $obra){
                    $inputSuscripcion = new \stdClass();
                    $inputSuscripcion->id_usuario = $usuario->id_usuario;
                    $inputSuscripcion->id_obra = $obra;
                    Suscripcion::create((array) $inputSuscripcion);
                }
            }else{
                $obras = Obra::get();
                foreach($obras as $obra){
                    $inputSuscripcion = new \stdClass();
                    $inputSuscripcion->id_usuario = $usuario->id_usuario;
                    $inputSuscripcion->id_obra = $obra->id_obra;
                    Suscripcion::create((array) $inputSuscripcion);
                }
            }

            SheetController::append($usuario);
            
            return redirect("/panel/usuarios#detalles&id=$usuario->id_usuario")->with('status', [
                'code' => 200,
                'message' => 'Usuario creado correctamente.',
            ]);
        }

        /**
         * * Show the "edit User" page.
         * @param mixed $slug - User slug.
         * @return [type]
         */
        public function showEditar($slug){
            $obras = Obra::get();
            $usuario = User::where('slug', '=', $slug)->get();
            $usuario = $usuario[0];
            $suscripciones = $usuario->suscripciones;
            $obrasToPush = [];
            foreach($suscripciones as $suscripcion){
                $obrasToPush[] = $suscripcion->id_obra;
            }
            $usuario->obras = $obrasToPush;

            return view('usuario.editar', [
                'usuario' => $usuario,
                'obras' => $obras,
                'validation' => (object)[
                    'rules' => User::$validation['editar']['general']['rules'],
                    'messages' => User::$validation['editar']['general']['messages']['es'],
                ],
            ]);
        }
        
        /**
         * * Edit a User.
         * @param Request $request
         * @param mixed $id_usuario - User primary key.
         * @return [type]
         */
        public function doEditar(Request $request, $id_usuario){
            $usuario = User::find($id_usuario);

            $input = (object) $request->all();
            $validator = Validator::make($request->all(), $this->replaceString(User::$validation['editar']['general']['rules'], "({[a-z_]*})", $usuario->id_usuario), User::$validation['editar']['general']['messages']['es']);
            if($validator->fails()){
                return redirect("/panel/usuario/$usuario->slug/editar")->withErrors($validator)->withInput();
            }

            if($input->id_nivel == 1){
                $validator = Validator::make($request->all(), $this->replaceString(User::$validation['editar']['suscriptor']['rules'], "({[a-z_]*})", $usuario->id_usuario), User::$validation['editar']['suscriptor']['messages']['es']);
                if($validator->fails()){
                    return redirect("/panel/usuario/$usuario->slug/editar")->withErrors($validator)->withInput();
                }
            }else{
                $input->estado = 3;
            }

            if(isset($input->correo_facturacion) || isset($input->correo_informacion) || isset($input->whatsapp) || isset($input->alta) || isset($input->baja) || isset($input->estado) || isset($input->detalles)){
                $validator = Validator::make($request->all(), $this->replaceString(User::$validation['editar']['avanzado']['rules'], "({[a-z_]*})", $usuario->id_usuario), User::$validation['editar']['avanzado']['messages']['es']);
                if($validator->fails()){
                    return redirect("/panel/usuario/$usuario->slug/editar")->withErrors($validator)->withInput();
                }
            }
    
            if($input->clave){
                $input->clave = \Hash::make($input->clave);
            }else{
                $input->clave = $usuario->clave;
            }

            if($usuario->nombre != $input->nombre){
                $input->slug = SlugService::createSlug(User::class, 'slug', $input->nombre);
            }else{
                $input->slug = $usuario->slug;
            }

            if(!$input->alta){
                $input->alta = date('Y-m-d', strtotime($usuario->updated_at));
            }
            
            $usuario->update((array) $input);
            
            foreach($usuario->suscripciones as $suscripcion){
                $suscripcion->delete();
            }

            if($input->id_nivel == 1){
                foreach($input->obras as $obra){
                    $inputSuscripcion = new \stdClass();
                    $inputSuscripcion->id_usuario = $usuario->id_usuario;
                    $inputSuscripcion->id_obra = $obra;
                    Suscripcion::create((array) $inputSuscripcion);
                }
            }else{
                $obras = Obra::get();
                foreach($obras as $obra){
                    $inputSuscripcion = new \stdClass();
                    $inputSuscripcion->id_usuario = $usuario->id_usuario;
                    $inputSuscripcion->id_obra = $obra->id_obra;
                    Suscripcion::create((array) $inputSuscripcion);
                }
            }
            
            return redirect("/panel/usuarios#detalles&id=$usuario->id_usuario")->with('status', [
                'code' => 200,
                'message' => "La Usuario: \"$usuario->nombre\" fue editado exitosamente.",
            ]);
        }

        /**
         * * Delete a User.
         * @param mixed $id_usuario - User primary key.
         * @return [type]
         */
        public function doEliminar($id_usuario){
            $usuario = User::find($id_usuario);

            foreach($usuario->suscripciones as $suscripcion){
                $suscripcion->delete();
            }
                
            $usuario->delete();
            
            return redirect()->route('usuario.panel')->with('status', [
                'code' => 200,
                'message' => "El Usuario fue eliminado exitosamente.",
            ]);
        }

        /**
         * * Get the User estado.
         * @param mixed $usuario - A User.
         * @return [type]
         */
        static function getEstado($usuario){
            switch($usuario->estado){
                case 0:
                    return (object) [
                        'id_estado' => 0,
                        'nombre' => 'Dado de baja',
                    ];
                case 1:
                    return (object) [
                        'id_estado' => 1,
                        'nombre' => 'Pendiente de confirmación',
                    ];
                case 2:
                    return (object) [
                        'id_estado' => 2,
                        'nombre' => 'Pendiente de aprobación',
                    ];
                case 3:
                    return (object) [
                        'id_estado' => 3,
                        'nombre' => 'Activo',
                    ];
            }
        }

        public function getPanelFiltros(){
            return [
                'components.filtros.obras' => Obra::get(),
            ];
        }
    }