<?php
    namespace App\Http\Middleware;

    use Auth;
    use Closure;

    class Admin{
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle($request, Closure $next){
            $usuario = Auth::user();
        
            if($usuario->id_nivel == 1){
                return redirect('/dashboard')->with('status', [
                    'code' => '403',
                    'message' => 'No tiene permiso de acceder a ésta sección.',
                ]);
            }
            
            return $next($request);
        }
    }