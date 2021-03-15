<?php
    namespace App\Http\Controllers;

    use App\Models\Obra;
    use Illuminate\Http\Request;

    class ObraController extends Controller{
        /**
         * * Get the count of Users Obras.
         * @param mixed $usuarios - Users.
         * @return [type]
         */
        static function getAll($usuarios){
            $obras = (object) [
                'data' => collect([]),
                'total' => 0,
                'cooperativas_completas' => 0,
                'cooperativas_trabajo' => 0,
                'asociaciones_mutuales' => 0,
                'uif' => 0,
            ];
            foreach ($usuarios as $usuario) {
                foreach($usuario->suscripciones as $suscripcion){
                    if(!$obras->data->contains(Obra::find($suscripcion->id_obra))){
                        $obras->data->push(Obra::find($suscripcion->id_obra));
                    }
                    $obras->total++;
                    switch($suscripcion->id_obra){
                        case 1:
                            $obras->cooperativas_completas++;
                            break;
                        case 2:
                            $obras->cooperativas_trabajo++;
                            break;
                        case 3:
                            $obras->asociaciones_mutuales++;
                            break;
                        case 4:
                            $obras->uif++;
                            break;
                    }
                }
            }

            return $obras;
        }
        
        /**
         * * Get the User Obras.
         * @param mixed $usuario - A User.
         * @return [type]
         */
        static function getByUsuario($usuario){
            $obras = collect([]);
            foreach($usuario->suscripciones as $suscripcion){
                $obra = Obra::find($suscripcion->id_obra);
                $obras->push($obra);
            }

            return $obras;
        }
        
        /**
         * * Get the Normativa Obras.
         * @param mixed $normativa - A Normativa.
         * @return [type]
         */
        static function getByNormativa($normativa){
            $obras = collect([]);
            foreach($normativa->relaciones as $relacion){
                $obra = Obra::find($relacion->id_obra);
                $obras->push($obra);
            }

            return $obras;
        }
        
        /**
         * * Get the Gestion Obras.
         * @param mixed $gestion - A Gestion.
         * @return [type]
         */
        static function getByGestion($gestion){
            $obras = collect([]);
            foreach($gestion->vinculos as $vinculo){
                $obra = Obra::find($vinculo->id_obra);
                $obras->push($obra);
            }

            return $obras;
        }
        
        /**
         * * Get the Tema Obras.
         * @param mixed $tema - A Tema.
         * @return [type]
         */
        static function getByTema($tema){
            $obras = collect([]);
            foreach($tema->nexos as $nexo){
                $obra = Obra::find($nexo->id_obra);
                $obras->push($obra);
            }

            return $obras;
        }
        
        /**
         * * Get the Categoria Obras.
         * @param mixed $categoria - A Categoria.
         * @return [type]
         */
        static function getByCategoria($categoria){
            $obras = collect([]);
            foreach($categoria->uniones as $union){
                $obra = Obra::find($union->id_obra);
                $obras->push($obra);
            }

            return $obras;
        }
    }