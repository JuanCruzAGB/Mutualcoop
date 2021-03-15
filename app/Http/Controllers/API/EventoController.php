<?php
    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Evento;
    use Auth;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;
    use Intervention\Image\ImageManagerStatic as Image;
    use Illuminate\Support\Facades\Validator;
    use Storage;

    class EventoController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Get all the Eventos.
         * @return [type]
         */
        public function getAll(){
            $eventos = Evento::orderBy('fecha', 'desc')->get();

            $total = 0;
            foreach($eventos as $evento){
                $total++;
            }
            
            return response()->json([
                'code' => 0,
                'message' => 'Ok',
                'data' => [
                    'eventos' => $eventos,
                    'total' => $total,
                ],
            ]);
        }
    }