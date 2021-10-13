<form id="cambiar_clave" class="auth-form px-4 rounded-lg lg:px-4 rounded w-full bg-white none" action="/cambiar-clave" method="post"
    data-rules="{{json_encode($validation->rules)}}"
    data-messages="{{json_encode($validation->messages)}}">
    <h2 class="text-2xl text-center py-8">Recuperar contraseña</h2>
    @csrf
    <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
        <input name="cambiarClave_dato"
            class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            type="text" placeholder="Email o Número de Suscriptor *" title="Campo obligatorio">
        @if($errors->has('cambiarClave_dato'))
            <span class="support support-box support-cambiarClave_dato error pl-1 font-bold w-full">{{$errors->first('cambiarClave_dato')}}</span>
        @else
            <span class="support support-box support-cambiarClave_dato error pl-1 font-bold w-full"></span>
        @endif
    </div>
    <div class="flex items-center justify-center lg:justify-center py-4">
        <input class="form-submit cambiar_clave btn btn-dos p-2 px-8 my-4" type="submit" value="Enviar">
    </div>
    {!! app('captcha')->display() !!}
    @if($errors->has('g-recaptcha-response'))
        <span class="support support-box support-g-recaptcha-response error pl-1 font-bold">{{$errors->first('g-recaptcha-response')}}</span>
    @else
        <span class="support support-box support-g-recaptcha-response error pl-1 font-bold"></span>
    @endif
    <div class="loguear text-center pb-8">
        <p>
            <a class="change-view text text-tres" href="#ingresar">Inicia sesión</a>
        </p>
        <p>
            <span>¿No tenés cuenta?</span>
            <a class="change-view text text-tres" href="#registrar">Registrate</a>
        </p>
    </div>
</form>
