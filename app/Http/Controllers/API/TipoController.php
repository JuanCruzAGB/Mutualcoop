<?php
    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Tipo;
    use Illuminate\Http\Request;

    class TipoController extends Controller{
        /** Busca los Tipos segun las Obra enviadas. */
        public function porObra(Request $request){
            $inputData = $request->all();
            $tipos = collect([]);
            $tipos_todos = Tipo::where('id_tipo', '>=', '4')->with('conexiones')->get();
            foreach($tipos_todos as $tipo){
                if(isset($inputData['obras'])){
                    foreach($inputData['obras'] as $obra){
                        foreach($tipo->conexiones as $conexion){
                            if(!$tipos->contains($tipo)){
                                if($conexion->id_obra == $obra){
                                    $tipos->push($tipo);
                                }
                            }
                        }
                    }
                }
            }

            return response()->json([
                'error' => 0,
                'data' => $tipos,
            ]);
        }
    }