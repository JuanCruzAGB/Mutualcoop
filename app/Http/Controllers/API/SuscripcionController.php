<?php
    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Conexion;
    use App\Models\Gestion;
    use App\Models\Normativa;
    use App\Models\Obra;
    use App\Models\Precio;
    use App\Models\Suscripcion;
    use App\Models\Tipo;
    use App\User;
    use Auth;
    use Illuminate\Http\Request;

    class SuscripcionController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Get all the Users "id_tipo_suscripcion" = 1 with the "id_nivel" = 1.
         * @return [type]
         */
        public function getAll($id_tipo_suscripcion = null, $id_obra = null){
            $usuarios = User::with('suscripciones')->where([['id_nivel', '=', 1],['estado', '>', 2],['id_tipo_suscripcion', '>', 0]])->get();

            $total = 0;
            $debito = 0;
            $semestral = 0;
            $anual = 0;
            $cooperativa_completa = 0;
            $cooperativa_trabajo = 0;
            $asociacion_mutual = 0;
            $uif = 0;
            $tipo = 0;
            $obra = 0;
            $usuariosCorrectas = [];

            foreach($usuarios as $usuario){
                $total++;
                $usuario->obras = collect([]);
                foreach($usuario->suscripciones as $suscripcion){
                    $obra = Obra::find($suscripcion->id_obra);
                    $usuario->obras->push($obra);
                    if(!$id_obra){
                        switch($suscripcion->id_obra){
                            case 1:
                                $cooperativa_completa++;
                                break;
                            case 2:
                                $cooperativa_trabajo++;
                                break;
                            case 3:
                                $asociacion_mutual++;
                                break;
                            case 4:
                                $uif++;
                                break;
                        }
                    }else{
                        if($suscripcion->id_obra == $id_obra){
                            $obra++;
                            $usuariosCorrectas[] = $usuario;
                        }
                    }
                }
                if(!$id_tipo_suscripcion){
                    switch($usuario->id_tipo_suscripcion){
                        case 1:
                            $debito++;
                            break;
                        case 2:
                            $semestral++;
                            break;
                        case 3:
                            $anual++;
                            break;
                    }
                }else{
                    if($usuario->id_tipo_suscripcion == $id_tipo_suscripcion){
                        $tipo++;
                        $usuariosCorrectas[] = $usuario;
                    }
                }
            }
            
            if(!$id_tipo_suscripcion){
                return response()->json([
                    'code' => 0,
                    'message' => 'Ok',
                    'data' => [
                        'usuarios' => $usuarios,
                        'total' => $total,
                        'debito' => $debito,
                        'semestral' => $semestral,
                        'anual' => $anual,
                        'cooperativa_completa' => $cooperativa_completa,
                        'cooperativa_trabajo' => $cooperativa_trabajo,
                        'asociacion_mutual' => $asociacion_mutual,
                        'uif' => $uif,
                    ],
                ]);
            }else if($id_tipo_suscripcion != null && !$id_obra){
                return response()->json([
                    'code' => 0,
                    'message' => 'Ok',
                    'data' => [
                        'usuarios' => $usuariosCorrectas,
                        'total' => $tipo,
                    ],
                ]);
            }else if(!$id_tipo_suscripcion && $id_obra != null){
                return response()->json([
                    'code' => 0,
                    'message' => 'Ok',
                    'data' => [
                        'usuarios' => $usuariosCorrectas,
                        'total' => $obra,
                    ],
                ]);
            }
        }

        /**
         * * Get all the Users with the "id_tipo_suscripcion" > 1.
         * @return [type]
         */
        public function getFacturaciones(){
            $usuarios = User::with('suscripciones')->where([['id_nivel', '=', 1],['estado', '>', 2],['id_tipo_suscripcion', '>', 1]])->get();

            $total = 0;
            $semestral = 0;
            $anual = 0;

            foreach($usuarios as $usuario){
                $total++;
                $obras = collect([]);
                $precios = [];
                foreach($usuario->suscripciones as $suscripcion){
                    $obra = Obra::find($suscripcion->id_obra);
                    $precios_suscripcion = Precio::where('id_obra', '=', $suscripcion->id_obra)->get();
                    foreach($precios_suscripcion as $precio){
                        $precios[] = $precio;
                        if($usuario->id_tipo_suscripcion == 2){
                            $semestral++;
                            $obra->nombre = $obra->nombre . ' ($' . $precio->valor_semestral . ')';
                        }else if($usuario->id_tipo_suscripcion == 3){
                            $anual++;
                            $obra->nombre = $obra->nombre . ' ($' . $precio->valor_anual . ')';
                        }
                    }
                    $obras->push($obra);
                }
                $usuario->obras = $obras;
                $usuario->valor_anual = 0;
                $usuario->valor_semestral = 0;
                foreach($precios as $precio){
                    $usuario->valor_anual += $precio->valor_anual;
                    $usuario->valor_semestral += $precio->valor_semestral;
                }
                if($usuario->id_tipo_suscripcion == 2){
                    $usuario->valor_original = $usuario->valor_semestral;
                }else{
                    $usuario->valor_original = $usuario->valor_anual;
                }
            }
            
            return response()->json([
                'code' => 0,
                'message' => 'Ok',
                'data' => [
                    'usuarios' => $usuarios,
                    'total' => $total,
                    'semestral' => $semestral,
                    'anual' => $anual,
                ],
            ]);
        }
    }