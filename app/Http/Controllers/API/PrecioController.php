<?php
    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Precio;
    use Illuminate\Http\Request;

    class PrecioController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Get all the Eventos.
         * @return [type]
         */
        public function getAll(){
            $precios = Precio::get();

            $total = 0;
            foreach($precios as $precio){
                $total++;
            }
            
            return response()->json([
                'code' => 0,
                'message' => 'Ok',
                'data' => [
                    'precios' => $precios,
                    'total' => $total,
                ],
            ]);
        }
    }