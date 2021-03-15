<?php
    namespace App\Http\Controllers;
    
    use App\Http\Controllers\CorreoController;
    use App\Models\Auth as AuthModel;
    use App\Models\Obra;
    use App\Models\Suscripcion;
    use App\User;
    use Auth;
    use Carbon\Carbon;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Laravel\Sanctum\HasApiTokens;

    class AuthController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Load the "log in" page.
         * @return [type]
         */
        public function showIngresar(){
            $precios = PrecioController::getAll();
            $obras = collect([]);
            foreach ($precios as $precio) {
                $precio->obra->valor_anual = $precio->valor_anual;
                $obras->push($precio->obra);
            }
            
            if(!Auth::user()){
                return view('auth.autenticacion',[
                    'obras' => $obras,
                    'validation' => (object)[
                        'ingresar' => (object)[
                            'rules' => AuthModel::$validation['ingresar']['rules'],
                            'messages' => AuthModel::$validation['ingresar']['messages']['es'],
                        ], 'registrar' => (object)[
                            'rules' => AuthModel::$validation['registrar']['general']['rules'],
                            'messages' => AuthModel::$validation['registrar']['general']['messages']['es'],
                        ], 'cambiar_clave' => (object)[
                            'rules' => AuthModel::$validation['cambiarClave']['send']['rules'],
                            'messages' => AuthModel::$validation['cambiarClave']['send']['messages']['es'],
                        ],
                    ],
                ]);
            }else{
                return redirect('/dashboard');
            }
        }
        
        /**
         * * Log the User.
         * @param Request $request
         * @return [type]
         */
        public function doIngresar(Request $request){
            $input = $this->makeInputsByExplode($request, 'ingresar_');
            $validator = Validator::make($request->all(), AuthModel::$validation['ingresar']['rules'], AuthModel::$validation['ingresar']['messages']['es']);
            if($validator->fails()){
                return redirect('/ingresar')->withErrors($validator)->withInput();
            }

            if(isset($input->recordar)){
                if($input->recordar){
                    $recordar = true;
                }else{
                    $recordar = false;
                }
            }else{
                $recordar = false;
            }

            if(!Auth::attempt(['password' => $input->clave, 'correo' => $input->dato], $recordar)){
                if(!Auth::attempt(['password' => $input->clave, 'id_suscriptor' => $input->dato], $recordar)){
                    return redirect('/ingresar#ingresar')->withInput()->with('status', [
                        'code' => 401,
                        'message' => 'Correo, Número de Suscriptor y/o clave incorrectos.',
                    ]);
                }
            }

            if(Auth::user()->estado < 1){
                Auth::logout();
                return redirect('/ingresar#ingresar')->withInput()->with('status', [
                    'code' => 403,
                    'message' => 'Su email ya se encuentra registrado pero aparece como dado de baja. Por favor escribirnos a info@mutualcoop.org.ar.',
                ]);
            }

            $user = Auth::user();
            return redirect('/dashboard');
        }
        
        /**
         * * Sign the User.
         * @param Request $request
         * @return [type]
         */
        public function doRegistrar(Request $request){
            $input = $this->makeInputsByExplode($request, 'registrar_');
            $validator = Validator::make($request->all(), AuthModel::$validation['registrar']['general']['rules'], AuthModel::$validation['registrar']['general']['messages']['es']);
            if($validator->fails()){
                return redirect('/ingresar#registrar')->withErrors($validator)->withInput();
            }

            if(isset($input->correo_facturacion) || isset($input->correo_informacion) || isset($input->whatsapp) || isset($input->alta) || isset($input->baja) || isset($input->estado) || isset($input->detalles)){
                $validator = Validator::make($request->all(), AuthModel::$validation['regisrar']['avanzado']['rules'], AuthModel::$validation['regisrar']['avanzado']['messages']['es']);
                if($validator->fails()){
                    return redirect('/ingresar#registrar')->withErrors($validator)->withInput();
                }
            }

            $id_suscriptor = 0;
            $usuarios = User::all();
            foreach($usuarios as $usuario){
                if($usuario->id_suscriptor >= $id_suscriptor){
                    $id_suscriptor = $usuario->id_suscriptor + 1;
                }
            }
    
            $input->id_suscriptor = $id_suscriptor;

            $input->estado = 1;

            $clave = $input->clave;

            $input->clave = \Hash::make($clave);

            $input->alta = Carbon::now()->format('Y-m-d');

            $input->slug = SlugService::createSlug(User::class, 'slug', $input->nombre);

            $usuario = User::create((array) $input);

            foreach($input->obras as $obra){
                $inputSuscripcion = new \stdClass();
                $inputSuscripcion->id_usuario = $usuario->id_usuario;
                $inputSuscripcion->id_obra = $obra;
                Suscripcion::create((array) $inputSuscripcion);
            }

            CorreoController::confirmar($usuario);

            Auth::attempt(['password' => $clave, 'correo' => $input->correo], true);
            return redirect('/dashboard')->with('status', [
                'code' => 200,
                'message' => 'Correo pendiente de confirmación.',
            ]);
        }

        /**
         * * Load the "reset password" page.
         * @param string $token
         * @return [type]
         */
        public function showPasswordReset($token){
            if(!DB::table('password_resets')->where('token', $token)->first()){
                DB::table('password_resets')->where('token', $token)->delete();
                return redirect('/')->with('status', [
                    'code' => 403,
                    'message' => 'Token invalido.',
                ]);
            }

            $password = DB::table('password_resets')->where('token', $token)->first();

            return view('auth.cambiar_clave',[
                'password' => $password,
                'validation' => (object)[
                    'rules' => AuthModel::$validation['cambiarClave']['reset']['rules'],
                    'messages' => AuthModel::$validation['cambiarClave']['reset']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Reset the User password.
         * @param Request $request
         * @return [type]
         */
        public function doPasswordResetForm(Request $request){
            $input = (object) $request->input();
            $validator = Validator::make($request->all(), AuthModel::$validation['cambiarClave']['reset']['rules'], AuthModel::$validation['cambiarClave']['reset']['messages']['es']);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if(!DB::table('password_resets')->where('token', $input->token)->first()){
                return redirect('/')->with('status', [
                    'code' => 403,
                    'message' => 'Algo salió mal.',
                ]);
            }

            $password = DB::table('password_resets')->where('token', $input->token)->first();

            if (count(User::where('correo', '=', $password->dato)->get())) {
                $user = User::where('correo', '=', $password->dato)->get()[0];
            } else {
                $user = User::where('id_suscriptor', '=', $password->dato)->get()[0];
            }

            DB::table('password_resets')->where('token', $input->token)->delete();

            $user->update(['clave' => \Hash::make($input->clave)]);

            return redirect('/ingresar')->with('status', [
                'code' => 200,
                'message' => 'Contraseña cambiada exitosamente.',
            ]);
        }

        /**
         * * Confirm the User email.
         * @param string $token - User token.
         * @return [type]
         */
        public function doConfirmEmail($token){
            if(!DB::table('password_resets')->where('token', $token)->first()){
                return redirect('/')->with('status', [
                    'code' => 403,
                    'message' => 'Algo salió mal.',
                ]);
            }

            $password = DB::table('password_resets')->where('token', $token)->first();

            $user = User::where('correo', '=', $password->dato)->get();
            $user = $user[0];

            DB::table('password_resets')->where('token', $token)->delete();

            $user->update(['estado' => 2]);

            CorreoController::avisarSuscripcion($user);

            return redirect('/dashboard')->with('status', [
                'code' => 200,
                'message' => 'Solicitud de registro enviada.',
            ]);
        }
        
        /** Desloguea al Usuario. */
        public function doSalir(){
            Auth::logout();
            return redirect()->route('web.inicio')->with('status', [
                'code' => 200,
                'message' => 'Sesión Cerrada.',
            ]);
        }
    }