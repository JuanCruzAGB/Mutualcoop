<?php
    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Obra;
    use App\Models\Categoria;
    use App\Models\Union;
    use Auth;
    use Illuminate\Http\Request;

    class CategoriaController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Get all the Categorias.
         * @return [type]
         */
        public function getAll(){
            $categorias = Categoria::with('tipo', 'uniones')->get();

            $total = 0;
            $administrativo_contable = 0;
            $impositivo = 0;
            $previsional = 0;
            $recursos = 0;
            $analisis_reglamentacion = 0;
            $informacion_complementaria = 0;
            $jurisprudencia = 0;
            foreach($categorias as $categoria){
                $total++;
                $categoria->obras = collect([]);
                foreach($categoria->uniones as $union){
                    $obra = Obra::find($union->id_obra);
                    $categoria->obras->push($obra);
                }
                switch($categoria->id_tipo_gestion){
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
            }
            
            return response()->json([
                'code' => 0,
                'message' => 'Ok',
                'data' => [
                    'categorias' => $categorias,
                    'total' => $total,
                    'administrativo_contable' => $administrativo_contable,
                    'impositivo' => $impositivo,
                    'previsional' => $previsional,
                    'recursos' => $recursos,
                    'analisis_reglamentacion' => $analisis_reglamentacion,
                    'informacion_complementaria' => $informacion_complementaria,
                    'jurisprudencia' => $jurisprudencia,
                ],
            ]);
        }
    }