<?php
    namespace App\Http\Controllers;

    use App\Http\Controllers\CorreoController;
    use App\Models\Conexion;
    use App\Models\Gestion;
    use App\Models\Normativa;
    use App\Models\Obra;
    use App\Models\Precio;
    use App\Models\Suscripcion;
    use App\Models\Tipo;
    use App\User;
    use Auth;
    use Illuminate\Http\Request;

    class OrganismoController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Get the count of Temas Organismos.
         * @param mixed $temas - Temas.
         * @return [type]
         */
        static function getAll($temas){
            $organismos = (object) [
                'total' => 0,
                'inaes' => 0,
                'otros_organismos' => 0,
            ];
            foreach ($temas as $tema) {
                $organismos->total++;
                switch($tema->id_organismo){
                    case 1:
                        $organismos->inaes++;
                        break;
                    case 2:
                        $organismos->otros_organismos++;
                        break;
                }
            }

            return $organismos;
        }
    }