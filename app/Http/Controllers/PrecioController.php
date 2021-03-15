<?php
    namespace App\Http\Controllers;

    use App\Models\Obra;
    use App\Models\Precio;
    use Auth;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class PrecioController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        /**
         * * Show the "valuables table" panel page.
         * @return [type]
         */
        public function panel(){
            $precios = Precio::get();

            foreach ($precios as $precio) {
                $precio->valor_mensual = round($precio->valor_anual / 12);
            }

            return view('precio.panel', [
                'usuario' => Auth::user(),
                'precios' => $precios,
                'tabs' => $this->getAdminTabs(),
                'filtros' => [],
            ]);
        }
        
        /**
         * * Show the "edit Precio" page.
         * @param mixed $id_precio - Precio primary key.
         * @return [type]
         */
        public function showEditar($id_precio){
            $precio = Precio::find($id_precio);

            return view('precio.editar', [
                'precio' => $precio,
                'validation' => (object)[
                    'rules' => Precio::$validation['editar']['rules'],
                    'messages' => Precio::$validation['editar']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Edit a Precio.
         * @param Request $request
         * @param mixed $id_precio - Precio primary key.
         * @return [type]
         */
        public function doEditar(Request $request, $id_precio){
            $precio = Precio::find($id_precio);

            $input = (object) $request->all();
            $validator = Validator::make($request->all(), Precio::$validation['editar']['rules'], Precio::$validation['editar']['messages']['es']);
            if($validator->fails()){
                return redirect("/panel/precio/$precio->slug/editar")->withErrors($validator)->withInput();
            }
            
            $input->id_usuario = Auth::id();
            
            $precio->update((array) $input);
            
            return redirect('/panel/precios')->with('status', [
                'code' => 200,
                'message' => "El Precio fue editado exitosamente.",
            ]);
        }
        
        /**
         * * Get the User billing.
         * @param mixed $usuario - A User.
         * @return [type]
         */
        static function getByUsuario($usuario){
            $obras = ObraController::getByUsuario($usuario);
            foreach ($obras as $obra) {
                $precios = Precio::where('id_obra', '=', $obra->id_obra)->get();
                foreach($precios as $precio){
                    $obra = Obra::find($precio->id_obra);
                    if(!($usuario->valor)){
                        $usuario->valor = 0;
                    }
                    switch ($usuario->id_tipo_suscripcion) {
                        case 2:
                            $usuario->valor += $precio->valor_semestral;
                            $precio->titulo = "$obra->nombre: $$usuario->valor";
                            break;
                        case 3:
                            $usuario->valor += $precio->valor_anual;
                            $precio->titulo = "$obra->nombre: $$usuario->valor";
                            break;
                    }
                }
            }

            return $precios;
        }
        
        static function getAll(){
            $precios = Precio::with('obra')->get();
            return $precios;
        }
    }