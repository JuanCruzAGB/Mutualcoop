<form id="ingresar" class="auth-form px-4 rounded-lg lg:px-4 rounded w-full bg-white" action="/ingresar" method="post"
    data-rules="{{json_encode($validation->rules)}}"
    data-messages="{{json_encode($validation->messages)}}">
    <header>
        <h2 class="text-2xl text-center py-8">Iniciar sesión</h2>
    </header>
    @csrf
    <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
        <input name="ingresar_dato"
            class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            type="text" placeholder="Email o número de suscriptor *" title="Campo obligatorio" value="{{old('ingresar_dato')}}">
        @if($errors->has("ingresar_dato"))
            <span class="support support-box support-ingresar_dato error w-full">{{ $errors->first("ingresar_dato") }}</span>
        @else
            <span class="support support-box support-ingresar_dato error w-full"></span>
        @endif
    </div>
    <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
        <label for='ingresar_clave' class="ver-password">
            <i class="fas fa-eye"></i>
        </label>
        <input id='ingresar_clave' name="ingresar_clave"
            class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            type="password" placeholder="Contraseña *" title="Campo obligatorio" value="{{old('ingresar_clave')}}">
        @if($errors->has("ingresar_clave"))
            <span class="support support-box support-ingresar_clave error w-full">{{ $errors->first("ingresar_clave") }}</span>
        @else
            <span class="support support-box support-ingresar_clave error w-full"></span>
        @endif
    </div>
    <div class="checkbox-obras w-8/12 mx-auto xl:w-8/12">
        <ul class="obras my-8">
            <li class="checkbox mx-auto w-8/12 md:w-7/12 lg:w-10/12">
                <input name="recordar" value="1" name="ingresar_recordar" {{ (is_array(old('ingresar_recordar')) && in_array(1, old('ingresar_recordad'))) ? 'checked' : '' }} class="form-input filter filter-checkbox" id="recordar" type="checkbox">
                <label class="mt-2" for="recordar">Recordarme</label>
            </li>
        </ul>
    </div>
    <div class="flex items-center justify-center lg:justify-center py-4">
        <button class="form-submit ingresar flex justify-center ingresar_submit btn btn-dos p-2 px-8 my-4" type="submit">Ingresar</button>
    </div>
    {!! app('captcha')->display() !!}
    @if($errors->has('g-recaptcha-response'))
        <span class="support support-box support-g-recaptcha-response error pl-1 font-bold">{{$errors->first('g-recaptcha-response')}}</span>
    @else
        <span class="support support-box support-g-recaptcha-response error pl-1 font-bold"></span>
    @endif
    <div class="loguear text-center pb-8">
        <p>
            <span>¿No tenés cuenta?</span>
            <a class="change-view text text-tres" href="#registrar">Suscribirme</a>
        </p>
        <p>
            <a class="change-view text text-tres" href="#cambiar_clave">¿Olvidaste tu contraseña?</a>
        </p>
    </div>
</form>