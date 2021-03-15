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

    class SuscripcionController extends Controller{
        /**
         * * Show the "suscribers table" panel page.
         * @return [type]
         */
        public function suscriptores(){
            $usuarios = User::with('suscripciones')->where([['id_nivel', '=', 1],['estado', '>', 2]])->get();

            $suscripciones = SuscripcionController::getAll($usuarios);
            $obras = ObraController::getAll($usuarios);

            foreach($usuarios as $usuario){
                $usuario->obras = ObraController::getByUsuario($usuario);
                $usuario->suscripcion  = $this::getOne($usuario);
            };

            return view('suscripcion.suscriptores', [
                'usuario' => Auth::user(),
                'usuarios' => $usuarios,
                'suscripciones' => $suscripciones,
                'obras' => $obras,
                'tabs' => $this->getAdminTabs(),
                'filtros' => $this->getSuscriptoresFiltros(),
            ]);
        }

        /**
         * * Show the "user billing table" panel page.
         * @return [type]
         */
        public function facturaciones(){
            $usuarios = User::with('suscripciones')->where([['id_nivel', '=', 1],['estado', '>', 2],['id_tipo_suscripcion', '>', 1]])->get();

            $suscripciones = SuscripcionController::getAll($usuarios);
            $obras = ObraController::getAll($usuarios);

            foreach($usuarios as $usuario){
                $usuario->obras = ObraController::getByUsuario($usuario);
                $usuario->suscripcion = $this::getOne($usuario);
                $usuario->valores = PrecioController::getByUsuario($usuario);
            };

            return view('suscripcion.facturaciones', [
                'usuario' => Auth::user(),
                'usuarios' => $usuarios,
                'suscripciones' => $suscripciones,
                'obras' => $obras,
                'tabs' => $this->getAdminTabs(),
                'filtros' => $this->getFacturacionesFiltros(),
            ]);
        }

        /**
         * * Approve the User.
         * @param mixed $id_usuario - User primary key.
         * @return [type]
         */
        public function aprobar($id_usuario){
            $usuario = User::find($id_usuario);
            $usuario->update(['estado' => 3]);

            CorreoController::avisarAprobacion($usuario);
            
            return redirect("/panel/usuarios#detalles?id=$id_usuario")->with('status', [
                'code' => 200,
                'message' => "Usuario aprobado exitosamente.",
            ]);
        }

        /**
         * * Get the count of Users suscriptions.
         * @param mixed $usuarios - Users.
         * @return [type]
         */
        static function getAll($usuarios){
            $suscripciones = (object) [
                'total' => 0,
                'debito' => 0,
                'semestral' => 0,
                'anual' => 0,
            ];
            foreach ($usuarios as $usuario) {
                $suscripciones->total++;
                switch($usuario->id_tipo_suscripcion){
                    case 1:
                        $suscripciones->debito++;
                        break;
                    case 2:
                        $suscripciones->semestral++;
                        break;
                    case 3:
                        $suscripciones->anual++;
                        break;
                }
            }

            return $suscripciones;
        }
        
        /**
         * * Get the User Obras.
         * @param mixed $usuario - A User.
         * @return [type]
         */
        static function getOne($usuario){
            $suscripcion = (object) [
                'nombre' => null,
            ];
            switch ($usuario->id_tipo_suscripcion) {
                case 1:
                    return (object) [
                        'id_tipo_suscripcion' => $usuario->id_tipo_suscripcion,
                        'nombre' => 'Debito',
                    ];
                    break;
                case 2:
                    return (object) [
                        'id_tipo_suscripcion' => $usuario->id_tipo_suscripcion,
                        'nombre' => 'Semestral',
                    ];
                    break;
                case 3:
                    return (object) [
                        'id_tipo_suscripcion' => $usuario->id_tipo_suscripcion,
                        'nombre' => 'Anual',
                    ];
                    break;
            }
        }
        
        /**
         * * Return the total of suscriptions.
         * @static
         * @return [type]
         */
        static public function getTotal(){
            $usuarios = User::with('suscripciones')->where([['id_nivel', '=', 1],['estado', '>', 2],['id_tipo_suscripcion', '>', 0]])->get();
            $total = 0;

            foreach($usuarios as $usuario){
                $total++;
                $usuario->obras = collect([]);
                foreach($usuario->suscripciones as $suscripcion){
                    $obra = Obra::find($suscripcion->id_obra);
                    $usuario->obras->push($obra);
                }
            }

            return (object) ['usuarios' => $usuarios, 'total' => $total];
        }

        /**
         * * Returns the total of suscriptions with "id_tipo_suscripcion" = 1.
         * @static
         * @return [type]
         */
        static public function getDebito(){
            $usuarios = User::with('suscripciones')->where([['id_nivel', '=', 1],['estado', '>', 2],['id_tipo_suscripcion', '>', 0]])->get();

            $debito = 0;
            $usuariosCorrectos = [];
            foreach($usuarios as $usuario){
                $usuario->obras = collect([]);
                foreach($usuario->suscripciones as $suscripcion){
                    $obra = Obra::find($suscripcion->id_obra);
                    $usuario->obras->push($obra);
                }
                switch($usuario->id_tipo_suscripcion){
                    case '1':
                        $debito++;
                        $usuariosCorrectos[] = $usuario;
                    break;
                }
            }

            return (object) ['usuarios' => $usuariosCorrectos, 'total' => $debito];
        }

        /**
         * * Returns the total of suscriptions with "id_tipo_suscripcion" = 2.
         * @static
         * @return [type]
         */
        static public function getSemestral(){
            $usuarios = User::with('suscripciones')->where([['id_nivel', '=', 1],['estado', '>', 2],['id_tipo_suscripcion', '>', 0]])->get();

            $semestral = 0;
            $usuariosCorrectos = [];
            foreach($usuarios as $usuario){
                $usuario->obras = collect([]);
                foreach($usuario->suscripciones as $suscripcion){
                    $obra = Obra::find($suscripcion->id_obra);
                    $usuario->obras->push($obra);
                }
                switch($usuario->id_tipo_suscripcion){
                    case '2':
                        $semestral++;
                        $usuariosCorrectos[] = $usuario;
                    break;
                }
            }

            return (object) ['usuarios' => $usuariosCorrectos, 'total' => $semestral];
        }

        /**
         * * Returns the total of suscriptions with "id_tipo_suscripcion" = 3.
         * @static
         * @return [type]
         */
        static public function getAnual(){
            $usuarios = User::with('suscripciones')->where([['id_nivel', '=', 1],['estado', '>', 2],['id_tipo_suscripcion', '>', 0]])->get();

            $anual = 0;
            $usuariosCorrectos = [];
            foreach($usuarios as $usuario){
                $usuario->obras = collect([]);
                foreach($usuario->suscripciones as $suscripcion){
                    $obra = Obra::find($suscripcion->id_obra);
                    $usuario->obras->push($obra);
                }
                switch($usuario->id_tipo_suscripcion){
                    case '3':
                        $anual++;
                        $usuariosCorrectos[] = $usuario;
                    break;
                }
            }

            return (object) ['usuarios' => $usuariosCorrectos, 'total' => $anual];
        }

        /**
         * * Returns the total of suscriptions with "id_obra" = 1.
         * @static
         * @return [type]
         */
        static public function getCooperativasCompletas(){
            $usuarios = User::with('suscripciones')->where([['id_nivel', '=', 1],['estado', '>', 2],['id_tipo_suscripcion', '>', 0]])->get();

            $cc = 0;
            $usuariosCorrectos = [];
            foreach($usuarios as $usuario){
                $usuario->obras = collect([]);
                foreach($usuario->suscripciones as $suscripcion){
                    $obra = Obra::find($suscripcion->id_obra);
                    $usuario->obras->push($obra);
                    switch($suscripcion->id_obra){
                        case '1':
                            $cc++;
                            $usuariosCorrectos[] = $usuario;
                        break;
                    }
                }
            }

            return (object) ['usuarios' => $usuariosCorrectos, 'total' => $cc];
        }

        /**
         * * Returns the total of suscriptions with "id_obra" = 2.
         * @static
         * @return [type]
         */
        static public function getCooperativasTrabajo(){
            $usuarios = User::with('suscripciones')->where([['id_nivel', '=', 1],['estado', '>', 2],['id_tipo_suscripcion', '>', 0]])->get();

            $ct = 0;
            $usuariosCorrectos = [];
            foreach($usuarios as $usuario){
                $usuario->obras = collect([]);
                foreach($usuario->suscripciones as $suscripcion){
                    $obra = Obra::find($suscripcion->id_obra);
                    $usuario->obras->push($obra);
                    switch($suscripcion->id_obra){
                        case '2':
                            $ct++;
                            $usuariosCorrectos[] = $usuario;
                        break;
                    }
                }
            }

            return (object) ['usuarios' => $usuariosCorrectos, 'total' => $ct];
        }

        /**
         * * Returns the total of suscriptions with "id_obra" = 3.
         * @static
         * @return [type]
         */
        static public function getAsociacionesMutuales(){
            $usuarios = User::with('suscripciones')->where([['id_nivel', '=', 1],['estado', '>', 2],['id_tipo_suscripcion', '>', 0]])->get();

            $am = 0;
            $usuariosCorrectos = [];
            foreach($usuarios as $usuario){
                $usuario->obras = collect([]);
                foreach($usuario->suscripciones as $suscripcion){
                    $obra = Obra::find($suscripcion->id_obra);
                    $usuario->obras->push($obra);
                    switch($suscripcion->id_obra){
                        case '3':
                            $am++;
                            $usuariosCorrectos[] = $usuario;
                        break;
                    }
                }
            }

            return (object) ['usuarios' => $usuariosCorrectos, 'total' => $am];
        }

        /**
         * * Returns the total of suscriptions with "id_obra" = 4.
         * @static
         * @return [type]
         */
        static public function getUIF(){
            $usuarios = User::with('suscripciones')->where([['id_nivel', '=', 1],['estado', '>', 2],['id_tipo_suscripcion', '>', 0]])->get();

            $uif = 0;
            $usuariosCorrectos = [];
            foreach($usuarios as $usuario){
                $usuario->obras = collect([]);
                foreach($usuario->suscripciones as $suscripcion){
                    $obra = Obra::find($suscripcion->id_obra);
                    $usuario->obras->push($obra);
                    switch($suscripcion->id_obra){
                        case '4':
                            $uif++;
                            $usuariosCorrectos[] = $usuario;
                        break;
                    }
                }
            }

            return (object) ['usuarios' => $usuariosCorrectos, 'total' => $uif];
        }

        /**
         * * Returns the total of facturations with "id_tipo_suscripcion" = 1.
         * @static
         * @return [type]
         */
        static public function getFacturaciones(){
            $usuarios = User::with('suscripciones')->where([['id_nivel', '=', 1],['estado', '>', 2],['id_tipo_suscripcion', '>', 1]])->get();

            foreach($usuarios as $usuario){
                $obras = collect([]);
                $precios = [];
                foreach($usuario->suscripciones as $suscripcion){
                    $obra = Obra::find($suscripcion->id_obra);
                    $precios_suscripcion = Precio::where('id_obra', '=', $suscripcion->id_obra)->get();
                    foreach($precios_suscripcion as $precio){
                        $precios[] = $precio;
                        if($usuario->id_tipo_suscripcion == 2){
                            $obra->nombre = $obra->nombre . ' ($' . $precio->valor_semestral . ')';
                        }else if($usuario->id_tipo_suscripcion == 3){
                            $obra->nombre = $obra->nombre . ' ($' . $precio->valor_anual . ')';
                        }
                    }
                    $obras->push($obra);
                }
                $usuario->obras = $obras;
                $usuario->valor_anual = 0;
                $usuario->valor_semestral = 0;
                foreach($precios as $precio){
                    $usuario->valor_anual += $precio->valor_anual;
                    $usuario->valor_semestral += $precio->valor_semestral;
                }
                if($usuario->id_tipo_suscripcion == 2){
                    $usuario->valor_original = $usuario->valor_semestral;
                }else{
                    $usuario->valor_original = $usuario->valor_anual;
                }
            }

            return $usuarios;
        }

        public function getSuscriptoresFiltros(){
            return [
                'components.filtros.obras' => Obra::get(),
            ];
        }

        public function getFacturacionesFiltros(){
            return [
                'components.filtros.mes' => 'alta',
            ];
        }
    }