<?php
    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Tema;
    use App\Models\Obra;
    use Illuminate\Http\Request;

    class TemaController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Get all the Temas.
         * @return [type]
         */
        public function getAll(){
            $temas = Tema::with('organismo', 'nexos')->get();

            $total = 0;
            $inaes = 0;
            $otros_organismos = 0;
            foreach($temas as $tema){
                $total++;
                $tema->obras = collect([]);
                foreach($tema->nexos as $nexo){
                    $obra = Obra::find($nexo->id_obra);
                    $tema->obras->push($obra);
                }
                if($tema->id_organismo == 1){
                    $inaes++;
                }else{
                    $otros_organismos++;
                }
            }
            
            return response()->json([
                'code' => 0,
                'message' => 'Ok',
                'data' => [
                    'temas' => $temas,
                    'total' => $total,
                    'inaes' => $inaes,
                    'otros_organismos' => $otros_organismos,
                ],
            ]);
        }
    }