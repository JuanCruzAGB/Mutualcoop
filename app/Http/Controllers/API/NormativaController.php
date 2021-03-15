<?php
    namespace App\Http\Controllers\API;

    use App\Models\Normativa;
    use App\Models\Obra;
    use App\Models\Suscripcion;
    use App\Models\Tema;
    use App\User;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;

    class NormativaController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Get all the Normativas.
         * @return [type]
         */
        public function getAll($id_tipo_normativa = null){
            $normativas = Normativa::with('tipo', 'relaciones', 'enlaces')->get();

            $total = 0;
            $ley = 0;
            $decreto = 0;
            $resolucion = 0;
            $tipo = 0;
            $normativasCorrectas = [];

            foreach($normativas as $normativa){
                $total++;
                $normativa->obras = collect([]);
                $normativa->temas = collect([]);
                foreach($normativa->relaciones as $relacion){
                    $obra = Obra::find($relacion->id_obra);
                    $normativa->obras->push($obra);
                }
                foreach($normativa->enlaces as $enlace){
                    $tema = Tema::find($enlace->id_tema);
                    $normativa->temas->push($tema);
                }
                $normativa->date = (new self)->createDate((new self)->idiom, $normativa);
                if(!$id_tipo_normativa){
                    switch($normativa->id_tipo_normativa){
                        case 1:
                            $ley++;
                            break;
                        case 2:
                            $decreto++;
                            break;
                        case 3:
                            $resolucion++;
                            break;
                    }
                }else{
                    if($normativa->id_tipo_normativa == $id_tipo_normativa){
                        $tipo++;
                        $normativasCorrectas[] = $normativa;
                    }
                }
            }
            
            if(!$id_tipo_normativa){
                return response()->json([
                    'code' => 0,
                    'message' => 'Ok',
                    'data' => [
                        'normativas' => $normativas,
                        'total' => $total,
                        'ley' => $ley,
                        'decreto' => $decreto,
                        'resolucion' => $resolucion,
                    ],
                ]);
            }else{
                return response()->json([
                    'code' => 0,
                    'message' => 'Ok',
                    'data' => [
                        'normativas' => $normativasCorrectas,
                        'total' => $tipo,
                    ],
                ]);
            }
        }
    }