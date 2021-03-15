<?php
    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Auth as AuthModel;
    use App\User;
    use Auth;
    use Carbon\Carbon;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Http\Request;

    class AuthController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Log the User.
         * @param Request $request
         * @return [type]
         */
        public function doIngresar(Request $request){
            $input = (object) $request->input();
            $validator = Validator::make($request->all(), AuthModel::$validation['ingresar']['rules'], AuthModel::$validation['ingresar']['messages']['es']);
            if($validator->fails()){
                return response()->json([
                    'code' => 404,
                    'data' => $validator->errors()->messages(),
                    'message' => 'Los campos no son válidos.',
                ]);
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
                    return response()->json([
                        'code' => 401,
                        'message' => 'Correo, Número de Suscriptor y/o clave incorrectos.',
                    ]);
                }
            }

            $user = Auth::user();
            if($user->id_nivel == 1){
                $user->token =  $user->createToken('mutualcoop_user')->accessToken; 
            }else{
                $user->token =  $user->createToken('mutualcoop_admin')->accessToken; 
            }

            if($user->estado < 1){
                Auth::logout();
                return response()->json([
                    'code' => 403,
                    'message' => 'Usuario baneado.',
                ]);
            }

            return response()->json([
                'code' => 200,
                'message' => 'Sesión Iniciada.',
                'data' => $user->token,
            ]);
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
                $errors = $this->joinErrors($validator, 'registrar_');
                return redirect('/ingresar#registrar')->withErrors($validator)->withInput();
            }

            if(isset($input->correo_facturacion) || isset($input->correo_informacion) || isset($input->whatsapp) || isset($input->alta) || isset($input->baja) || isset($input->estado) || isset($input->detalles)){
                $validator = Validator::make($request->all(), AuthModel::$validation['regisrar']['avanzado']['rules'], AuthModel::$validation['regisrar']['avanzado']['messages']['es']);
                if($validator->fails()){
                    $errors = $this->joinErrors($validator, 'registrar_');
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

            $clave = $input->clave;

            $input->clave = \Hash::make($input->clave);

            $input->alta = Carbon::now()->format('Y-m-d');

            $input->slug = SlugService::createSlug(User::class, 'slug', $input->nombre);

            $usuario = User::create((array) $input);

            foreach($input->obras as $obra){
                $inputSuscripcion = new \stdClass();
                $inputSuscripcion->id_usuario = $usuario->id_usuario;
                $inputSuscripcion->id_obra = $obra;
                Suscripcion::create((array) $inputSuscripcion);
            }

            Auth::attempt(['password' => $clave, 'correo' => $input->correo], true);
            return redirect('/dashboard')->with('status', [
                'code' => 200,
                'message' => 'Usuario creado corretamente.',
            ]);
        }
    }