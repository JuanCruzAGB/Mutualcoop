<?php
    namespace App\Http\Controllers;

    use App\Models\Nivel;
    use Illuminate\Http\Request;

    class NivelController extends Controller{
        /**
         * * Get the count of Users suscriptions.
         * @param mixed $usuarios - Users.
         * @return [type]
         */
        static function getAll($usuarios){
            $niveles = (object) [
                'data' => collect([]),
                'total' => 0,
                'suscriptores' => 0,
                'administradores' => 0,
            ];
            foreach ($usuarios as $usuario) {
                if(!$niveles->data->contains(Nivel::find($usuario->id_nivel))){
                    $niveles->data->push(Nivel::find($usuario->id_nivel));
                }
                $niveles->total++;
                switch($usuario->id_nivel){
                    case 1:
                        $niveles->suscriptores++;
                        break;
                    case 2:
                        $niveles->administradores++;
                        break;
                }
            }

            return $niveles;
        }
    }