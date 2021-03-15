<?php
    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Obra;
    use App\User;
    use Auth;
    use Illuminate\Http\Request;

    class UsuarioController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Get all the Users.
         * @return [type]
         */
        public function getAll(){
            $usuarios = User::with('suscripciones', 'nivel')->get();

            $total = 0;
            $suscriptores = 0;
            $administradores = 0;

            foreach($usuarios as $usuario){
                $usuario->obras = collect([]);
                foreach($usuario->suscripciones as $suscripcion){
                    $obra = Obra::find($suscripcion->id_obra);
                    $usuario->obras->push($obra);
                }
                $usuario->date = $this->createDate($this->idiom, $usuario);
                switch($usuario->id_tipo_suscripcion){
                    case 1:
                        $nombre = 'Debito';
                        break;
                    case 2:
                        $nombre = 'Semestral';
                        break;
                    case 3:
                        $nombre = 'Anual';
                        break;
                }
                $usuario->tipo = (object) [
                    'id_tipo' => $usuario->id_tipo_suscripcion,
                    'nombre' => $nombre,
                ];
                switch($usuario->estado){
                    case 0:
                        $nombre = 'Dado de baja';
                        break;
                    case 1:
                        $nombre = 'Pendiente de Confirmación';
                        break;
                    case 2:
                        $nombre = 'Pendiente de Aprobación';
                        break;
                    case 3:
                        $nombre = 'Activo';
                        break;
                }
                $usuario->tipo_estado = (object) [
                    'nombre' => $nombre,
                ];
                $total++;
                switch($usuario->id_nivel){
                    case 1:
                        $suscriptores++;
                        break;
                    case 2:
                        $administradores++;
                        break;
                }
            };
            return response()->json([
                'code' => 0,
                'message' => 'Ok',
                'data' => [
                    'usuarios' => $usuarios,
                    'total' => $total,
                    'suscriptores' => $suscriptores,
                    'administradores' => $administradores,
                ],
            ]);
        }
    }