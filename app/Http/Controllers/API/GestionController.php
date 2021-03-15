<?php
    namespace App\Http\Controllers\API;

    use App\Models\Gestion;
    use App\Models\Obra;
    use App\Models\Suscripcion;
    use App\User;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;

    class GestionController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Get all the Gestiones.
         * @return [type]
         */
        public function getAll($id_tipo_gestion = null){
            $gestiones = Gestion::with('tipo', 'vinculos', 'categoria')->get();

            $total = 0;
            $administrativo_contable = 0;
            $impositivo = 0;
            $previsional = 0;
            $recursos = 0;
            $analisis_reglamentacion = 0;
            $informacion_complementaria = 0;
            $jurisprudencia = 0;
            $tipo = 0;
            $categorias = [];

            $gestionesCorrectas = [];
            foreach($gestiones as $gestion){
                $total++;
                $gestion->obras = collect([]);
                foreach($gestion->vinculos as $vinculo){
                    $obra = Obra::find($vinculo->id_obra);
                    $gestion->obras->push($obra);
                }
                $gestion->date = (new self)->createDate((new self)->idiom, $gestion);
                if($gestion->categoria){
                    if(isset($categorias[$gestion->categoria->slug])){
                        $categorias[$gestion->categoria->slug]++;
                    }else{
                        $categorias[$gestion->categoria->slug] = 1;
                    }
                }
                if(!$id_tipo_gestion){
                    switch($gestion->id_tipo_gestion){
                        case 4:
                            $administrativo_contable++;
                            break;
                        case 5:
                            $impositivo++;
                            break;
                        case 6:
                            $previsional++;
                            break;
                        case 7:
                            $recursos++;
                            break;
                        case 8:
                            $analisis_reglamentacion++;
                            break;
                        case 9:
                            $informacion_complementaria++;
                            break;
                        case 10:
                            $jurisprudencia++;
                            break;
                    }
                }else{
                    if($gestion->id_tipo_gestion == $id_tipo_gestion){
                        $tipo++;
                        $gestionesCorrectas[] = $gestion;
                    }
                }
            }
            
            if(!$id_tipo_gestion){
                return response()->json([
                    'code' => 0,
                    'message' => 'Ok',
                    'data' => [
                        'gestiones' => $gestiones,
                        'total' => $total,
                        'administrativo_contable' => $administrativo_contable,
                        'impositivo' => $impositivo,
                        'previsional' => $previsional,
                        'recursos' => $recursos,
                        'analisis_reglamentacion' => $analisis_reglamentacion,
                        'informacion_complementaria' => $informacion_complementaria,
                        'jurisprudencia' => $jurisprudencia,
                        'categorias' => $categorias,
                    ],
                ]);
            }else{
                return response()->json([
                    'code' => 0,
                    'message' => 'Ok',
                    'data' => [
                        'gestiones' => $gestionesCorrectas,
                        'categorias' => $categorias,
                        'total' => $tipo,
                    ],
                ]);
            }
        }
    }