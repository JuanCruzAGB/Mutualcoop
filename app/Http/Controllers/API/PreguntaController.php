<?php
    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Pregunta;
    use Auth;
    use Illuminate\Http\Request;

    class PreguntaController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Get all the Preguntas.
         * @return [type]
         */
        public function getAll(){
            $preguntas = Pregunta::get();

            $total = 0;

            foreach($preguntas as $pregunta){
                $total++;
            };

            return response()->json([
                'code' => 0,
                'message' => 'Ok',
                'data' => [
                    'preguntas' => $preguntas,
                    'total' => $total,
                ],
            ]);
        }
    }