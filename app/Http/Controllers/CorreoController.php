<?php
    namespace App\Http\Controllers;

    use App\Mail\AvisarAprobacionMail;
    use App\Mail\AvisarSuscripcionMail;
    use App\Mail\AvisarSuscriptorMail;
    use App\Mail\CambiarClaveMail;
    use App\Mail\ConfirmarMail;
    use App\Mail\ContactarMail;
    use App\Mail\ConsultarMail;
    use App\Models\Auth as AuthModel;
    use App\Models\Web;
    use App\User;
    use Auth;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Validator;

    class CorreoController extends Controller{
        /**
         * * Send the "contact" mail.
         * @param Request $request
         * @return [type]
         */
        public function contactar(Request $request){
            $input = $request->input();
            
            $validator = Validator::make($request->all(), Web::$validation['contactar']['rules'], Web::$validation['contactar']['messages']['es']);
            if($validator->fails()){
                dd($validator);
                return redirect('/#contacto')->withErrors($validator)->withInput();
            }

            $objDemo = new \stdClass();
            $objDemo->nombre = $input['nombre'];
            $objDemo->correo = $input['correo'];
            $objDemo->telefono = $input['telefono'];
            $objDemo->mensaje = $input['mensaje'];

            Mail::to('info@mutualcoop.org.ar')->send(new ContactarMail($objDemo));

            return redirect()->route('correo.gracias')->with('status', [
                'code' => 200, 
                'message' => 'Gracias por contactarte, te responderemos en la brevedad.'
            ]);
        }

        /**
         * * Semd the "question" mail.
         * @param Request $request
         * @return [type]
         */
        public function consultar(Request $request){
            $input = $request->input();
            
            $validator = Validator::make($request->all(), Web::$validation['consultar']['rules'], Web::$validation['consultar']['messages']['es']);
            if($validator->fails()){
                return redirect('/dashboard#consultar')->withErrors($validator)->withInput();
            }

            $objDemo = new \stdClass();
            $objDemo->correo = Auth::user()->correo;
            if(isset(Auth::user()->id_suscriptor) && Auth::user()->id_suscriptor != null){
                $objDemo->id_suscriptor = Auth::user()->id_suscriptor;
            }else{
                $objDemo->id_suscriptor = 'No cuenta con número de suscriptor';
            }

            $objDemo->consulta = $input['consulta'];

            Mail::to('info@mutualcoop.org.ar')->send(new ConsultarMail($objDemo));

            return redirect()->route('correo.gracias')->with('status', [
                'code' => 200, 
                'message' => 'Tu consulta será respondida en la brevedad, muchas gracias.',
            ]);
        }

        /**
         * * Send the "forgot password" mail.
         * @param Request $request
         * @return [type]
         */
        public function cambiarClave(Request $request){
            $input = $this->makeInputsByExplode($request, 'cambiarClave_');
            $validator = Validator::make($request->all(), AuthModel::$validation['cambiarClave']['send']['rules'], AuthModel::$validation['cambiarClave']['send']['messages']['es']);
            if($validator->fails()){
                return redirect('/ingresar#cambiar_clave')->withErrors($validator)->withInput();
            }
            
            if(!count(User::where('correo', '=', $input->dato)->get())){
                if(!count(User::where('id_suscriptor', '=', $input->dato)->get())){
                    return redirect('/ingresar#cambiar_clave')->with('status', [
                        'code' => 404,
                        'message' => 'Correo o Número de Suscriptor incorrectos.',
                    ]);
                }else{
                    $type = 'id_suscriptor';
                }
            }else{
                $type = 'correo';
            }

            $user = User::where($type, '=', $input->dato)->get();
            $user = $user[0];
            if($user->estado < 1){
                return redirect('/ingresar#cambiar_clave')->with('status', [
                    'code' => 403,
                    'message' => 'Usuario baneado.',
                ]);
            }

            $token = str_random(60);

            DB::table('password_resets')->insert([
                'dato' => $input->dato,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            
            $objDemo = new \stdClass();
            $objDemo->nombre = $user->nombre;
            $objDemo->correo = $user->correo;
            $objDemo->id_suscriptor = $user->id_suscriptor;
            $objDemo->token = $token;

            Mail::to($user->correo)->send(new CambiarClaveMail($objDemo));

            return redirect()->route('correo.gracias')->with('status', [
                'code' => 200,
                'message' => 'Su solicitud a sido enviada al correo, siga los pasos dados ahí.'
            ]);
        }

        /**
         * * Send the "confirmation" mail.
         * @static
         * @param Request $request
         * @return [type]
         */
        static public function confirmar(User $user){
            DB::table('password_resets')->insert([
                'dato' => $user->correo,
                'token' => str_random(60),
                'created_at' => Carbon::now(),
            ]);
            
            $password = DB::table('password_resets')->where('dato', $user->correo)->first();

            $objDemo = new \stdClass();
            $objDemo->nombre = $user->nombre;
            $objDemo->correo = $user->correo;
            $objDemo->id_suscriptor = $user->id_suscriptor;
            $objDemo->token = $password->token;

            Mail::to($user->correo)->send(new ConfirmarMail($objDemo));

            return [
                'code' => 200,
                'message' => 'Por favor confirme su correo electronico para continuar.'
            ];
        }

        /**
         * * Send the "there is a new suscriber" mail.
         * @static
         * @param Request $request
         * @return [type]
         */
        static public function avisarSuscripcion(User $user){
            $objDemo = new \stdClass();
            $objDemo->nombre = $user->nombre;
            $objDemo->correo = $user->correo;
            $objDemo->id_suscriptor = $user->id_suscriptor;

            Mail::to($user->correo)->send(new AvisarSuscripcionMail($objDemo));
            Mail::to('info@mutualcoop.org.ar')->send(new AvisarSuscriptorMail($objDemo));

            return [
                'code' => 200,
                'message' => 'Su solicitud a sido enviada al correo especificado, siga los pasos dados ahí.'
            ];
        }

        /**
         * * Send the "your user was approved" mail.
         * @static
         * @param Request $request
         * @return [type]
         */
        static public function avisarAprobacion(User $user){
            $objDemo = new \stdClass();
            $objDemo->nombre = $user->nombre;
            $objDemo->correo = $user->correo;
            $objDemo->id_suscriptor = $user->id_suscriptor;

            Mail::to($user->correo)->send(new AvisarAprobacionMail($objDemo));

            return [
                'code' => 200,
                'message' => 'Su solicitud a sido enviada al correo especificado, siga los pasos dados ahí.'
            ];
        }

        /**
         * * Load the "Thak You" page.
         * @return [type]
         */
        public function gracias(){
            return view('correo.gracias');
        }
    }