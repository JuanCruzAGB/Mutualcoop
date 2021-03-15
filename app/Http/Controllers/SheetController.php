<?php
    namespace App\Http\Controllers;

    use Sheets;
    
    class SheetController extends Controller{
        /**
         * * Appends a User to the Google Sheet
         * @param User $usuario
         * @return [type]
         */
        static public function append($usuario){
            if ($usuario->estado == 0) {
                $estado = 'Dado de baja';
            } else if ($usuario->estado == 1) {
                $estado = 'Pendiente de confirmación';
            } else if ($usuario->estado == 2) {
                $estado = 'Pendiente de aprobación';
            } else {
                $estado = 'Activo';
            }
            $array = [
                $usuario->id_usuario,
                $usuario->id_suscriptor,
                $usuario->correo,
                $usuario->correo_facturacion,
                $usuario->correo_informacion,
                $usuario->nombre,
                $usuario->entidad,
                $usuario->provincia,
                $usuario->direccion,
                $usuario->localidad,
                $usuario->cuit_cuil,
                $usuario->cbu,
                $usuario->telefono,
                $usuario->whatsapp,
                $usuario->alta,
                $usuario->baja,
                $estado,
            ];
            // Sheets::spreadsheet('1L0lXqtkWCaYTO54MLAVrRb4MuoopLnNh_ZNpsbzJojI')->sheet('Usuarios')->append($array);
        }
    }