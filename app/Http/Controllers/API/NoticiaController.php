<?php
    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Noticia;
    use Illuminate\Http\Request;

    class NoticiaController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Get all the Noticias.
         * @return [type]
         */
        public function getAll(){
            $noticias = Noticia::get();

            $total = 0;
            foreach($noticias as $noticia){
                $total++;
            }
            
            return response()->json([
                'code' => 0,
                'message' => 'Ok',
                'data' => [
                    'noticias' => $noticias,
                    'total' => $total,
                ],
            ]);
        }
    }