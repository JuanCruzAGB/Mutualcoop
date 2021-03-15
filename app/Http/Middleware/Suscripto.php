<?php
    namespace App\Http\Middleware;

    use App\Models\Obra;
    use App\Models\Suscripcion;
    use Auth;
    use Closure;

    class Suscripto{
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle($request, Closure $next){
            $suscripciones = Suscripcion::where('id_usuario', '=', Auth::id())->get();
            // dd($suscripciones);
            if($request->route('obra_slug')){
                $obra = Obra::findBySlug($request->route('obra_slug'));
            }
        
            $success = false;
            foreach($suscripciones as $suscripcion){
                if($suscripcion->id_obra == $obra->id_obra){
                    $success = true;
                }
            }
            
            if($success){
                return $next($request);
            }else{
                return redirect('/suscripciones');
            }
        }
    }