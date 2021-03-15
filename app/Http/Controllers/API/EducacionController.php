<?php
    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Educacion;
    use Illuminate\Http\Request;

    class EducacionController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Get all the Eventos.
         * @return [type]
         */
        public function getAll(){
            $educaciones = Educacion::get();

            $total = 0;
            foreach($educaciones as $educacion){
                $total++;
                $educacion->date = $this->createDate($this->idiom, $educacion);
            }
            
            return response()->json([
                'code' => 0,
                'message' => 'Ok',
                'data' => [
                    'educaciones' => $educaciones,
                    'total' => $total,
                ],
            ]);
        }
    }