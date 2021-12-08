<?php
    namespace App\Http\Controllers;
    
    use App\Mail\ContactarMail;
    use App\Mail\ConsultarMail;
    use App\Models\Categoria;
    use App\Models\Conexion;
    use App\Models\Educacion;
    use App\Models\Evento;
    use App\Models\Gestion;
    use App\Models\Normativa;
    use App\Models\Noticia;
    use App\Models\Obra;
    use App\Models\Precio;
    use App\Models\Pregunta;
    use App\Models\Relacion;
    use App\Models\Organismo;
    use App\Models\Suscripcion;
    use App\Models\Tema;
    use App\Models\Tipo;
    use App\Models\Vinculo;
    use App\Models\Web;
    use App\User;
    use Auth;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use Arcanedev\NoCaptcha\Rules\CaptchaRule;

    class WebController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Show the "home" page.
         * @return [type]
         */
        public function inicio(){
            $noticias = Noticia::orderBy('updated_at', 'DESC')->limit(6)->get();
            $eventos = Evento::orderBy('fecha', 'desc')->get();
            $eventos_pasados = collect([]);
            $eventos_proximos = collect([]);
            $obras = Obra::get();
            $preguntas = Pregunta::where('privado', '=', 0)->get();

            $fechas = $this->getTranslatedMinifiedMonth();

            foreach($eventos as $evento){
                if($evento->fecha > date('Y-m-d')){
                    $evento->descripcion = $this->escapeTags($evento->descripcion);
                    $evento->mes = $fechas[date('M', strtotime('2020-11-01'))];
                    $eventos_proximos->push($evento);
                }else{
                    $evento->descripcion = $this->escapeTags($evento->descripcion);
                    $evento->minified = (object) [
                        'descripcion' => $this->minific($evento->descripcion, 100),
                    ];
                    $evento->fecha = $this->createDate($this->idiom, $evento->fecha);
                    $eventos_pasados->push($evento);
                }
            }

            foreach($noticias as $noticia){
                $noticia->minified = (object) [
                    'descripcion' => $this->minific($noticia->descripcion, 100),
                ];
            }

            for($i = 0; $i < count($preguntas); $i++){ 
                if($i == 0){
                    $preguntas[$i]->opened = true;
                }else{
                    $preguntas[$i]->opened = false;
                }
            }

            $rules = Web::$validation['contactar']['rules'];

            return view('web.home', [
                'noticias' => $noticias,
                'eventos_pasados' => $eventos_pasados,
                'eventos_proximos' => $eventos_proximos,
                'obras' => $obras,
                'preguntas' => $preguntas,
                'validation' => (object)[
                    'rules' => $rules,
                    'messages' => Web::$validation['contactar']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Show the "dashboard panel" page.
         * @return [type]
         */
        public function dashboard(){
            $usuario = Auth::user();
            $eventos = Evento::orderBy('fecha', 'desc')->get();
            $eventos_pasados = collect([]);
            $preguntas = Pregunta::where('privado', '=', 1)->get();
            $noticias = Noticia::orderBy('updated_at', 'DESC')->limit(3)->get();

            $usuarios = User::where('estado', '=', 2)->get();

            $fechas = $this->getTranslatedMinifiedMonth();

            foreach($eventos as $evento){
                if($evento->fecha < date('Y-m-d')){
                    $evento->descripcion = $this->escapeTags($evento->descripcion);
                    $evento->minified = (object) [
                        'descripcion' => $this->minific($evento->descripcion, 100),
                    ];
                    $evento->fecha = $this->createDate($this->idiom, $evento->fecha);
                    $eventos_pasados->push($evento);
                }
            }

            for($i = 0; $i < count($preguntas); $i++){ 
                if($i == 0){
                    $preguntas[$i]->opened = true;
                }else{
                    $preguntas[$i]->opened = false;
                }
            }

            $suscriptions = [];

            if ($usuario->id_nivel > 1) {
                foreach($usuarios as $user){
                    $suscription = (object) [
                        'id' => "suscription-$user->id_usuario",
                        'message' => "<span>Se ha suscripto un nuevo usuario, número de suscriptor: </span><a class='sub-boton' href='/panel/usuarios#detalles?id=$user->id_usuario'>$user->id_suscriptor</a><span>,  confirme si desea aprobarlo o no.<span>",
                        'url' => "/usuario/$user->id_usuario/aprobar",
                        'method' => 'POST',
                    ];
                    array_push($suscriptions, $suscription);
                }
            }
            

            return view('web.dashboard', [
                'usuario' => $usuario,
                'eventos_pasados' => $eventos_pasados,
                'preguntas' => $preguntas,
                'suscriptions' => $suscriptions,
                'noticias' => $noticias,
                'suscriptores' => (object) [
                    'total' => SuscripcionController::getTotal(),
                    'debito' => SuscripcionController::getDebito(),
                    'semestral' => SuscripcionController::getSemestral(),
                    'anual' => SuscripcionController::getAnual(),
                    'cooperativas_completas' => SuscripcionController::getCooperativasCompletas(),
                    'cooperativas_trabajo' => SuscripcionController::getCooperativasTrabajo(),
                    'asociaciones_mutuales' => SuscripcionController::getAsociacionesMutuales(),
                    'uif' => SuscripcionController::getUIF(),
                ], 'validation' => (object)[
                    'rules' => Web::$validation['consultar']['rules'],
                    'messages' => Web::$validation['consultar']['messages']['es'],
                ],
            ]);
        }
    }