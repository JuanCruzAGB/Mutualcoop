<form id="registrar" class="auth-form px-4 rounded-lg lg:px-4 rounded w-full bg-white none" action="/registrar" method="post"
    data-rules="{{json_encode($validation->rules)}}"
    data-messages="{{json_encode($validation->messages)}}">
    @csrf
    <div class="step step-1">
        <header>
            <h2 class="text-2xl text-center pt-8">Registro de Mutualcoop</h2>
            <h3 class="text-1xl text-center pb-8">Primer paso</h3>
        </header>
        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
            <input name="registrar_nombre"
                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="text" placeholder="Nombre *" title="Campo obligatorio" value="{{old('registrar_nombre')}}">
                    @if($errors->has('registrar_nombre'))
                        <span class="support support-box support-registrar_nombre error pl-1 font-bold w-full">{{$errors->first('registrar_nombre')}}</span>
                    @else
                        <span class="support support-box support-registrar_nombre error pl-1 font-bold w-full"></span>
                    @endif
        </div>
        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
            <input name="registrar_correo"
                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="email" placeholder="Correo *" title="Campo obligatorio" value="{{old('registrar_correo')}}">
                    @if($errors->has('registrar_correo'))
                        <span class="support support-box support-registrar_correo error pl-1 font-bold w-full">{{$errors->first('registrar_correo')}}</span>
                    @else
                        <span class="support support-box support-registrar_correo error pl-1 font-bold w-full"></span>
                    @endif
        </div>
        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
            <input name="registrar_telefono"
                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                 type="text" placeholder="Télefono *" title="Campo obligatorio" value="{{old('registrar_telefono')}}">
                    @if($errors->has('registrar_telefono'))
                        <span class="support support-box support-registrar_telefono error pl-1 font-bold w-full">{{$errors->first('registrar_telefono')}}</span>
                    @else
                        <span class="support support-box support-registrar_telefono error pl-1 font-bold w-full"></span>
                    @endif
        </div>
        <div class="flex items-center justify-center py-4">
            <a href="#step-2" class="step-button step-1-button flex justify-center items-center btn btn-dos p-2 px-8 my-4">
                <span class="text">Paso siguiente</span>
                <i class="step-icon fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>

    <div class="step step-2">
        <header>
            <h2 class="text-2xl text-center pt-8">Detallá tu Suscripción</h2>
            <h3 class="text-1xl text-center pb-8">Segundo paso</h3>
        </header>
        <div class="mb-4 flex justify-center flex-wrap mb-8 outline-none">
            <select class="form-input p-3 outline-none bg-white" name="registrar_id_tipo_suscripcion" title="Campo obligatorio">
                <option {{ !old('registrar_id_tipo_suscripcion') ? 'selected' : '' }} disabled>Elige cada cuanto queres pagar *</option>
                <option {{ old('registrar_id_tipo_suscripcion') == 1 ? 'selected' : '' }} value="1">Mensual</option>
                <option {{ old('registrar_id_tipo_suscripcion') == 3 ? 'selected' : '' }} value="3">Anual</option>
            </select>
                    @if($errors->has('registrar_id_tipo_suscripcion'))
                        <span class="support support-box support-registrar_id_tipo_suscripcion error pl-1 font-bold w-full">{{$errors->first('registrar_id_tipo_suscripcion')}}</span>
                    @else
                        <span class="support support-box support-registrar_id_tipo_suscripcion error pl-1 font-bold w-full"></span>
                    @endif
        </div>
        <div class="checkbox-obras w-8/12 mx-auto xl:w-8/12">
            <ul class="obras my-8">
                @foreach($obras as $obra)
                    <li>
                        @if(is_array(old('registrar_obras')) && in_array($obra->id_obra, old('registrar_obras')))
                            <input value="{{$obra->id_obra}}" class="form-input" name="registrar_obras[{{$obra->slug}}]" checked id="{{$obra->slug}}" type="checkbox">
                        @else
                            <input value="{{$obra->id_obra}}" class="form-input" name="registrar_obras[{{$obra->slug}}]" id="{{$obra->slug}}" type="checkbox">
                        @endif
                        <label class="mt-2 registrar_obras" for="{{$obra->slug}}">{{$obra->nombre}}</label>
                    </li>
                @endforeach
            </ul>
        </div>
        @if($errors->has('registrar_obras'))
            <span class="support support-box support-registrar_obras error pl-1 font-bold w-full">{{$errors->first('registrar_obras')}}</span>
        @else
            <span class="support support-box support-registrar_obras error pl-1 font-bold w-full"></span>
        @endif
        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
            <input name="registrar_cbu" placeholder="CBU *" title="Campo obligatorio" value="{{old('registrar_cbu')}}"
                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="number">
                    @if($errors->has('registrar_cbu'))
                        <span class="support support-box support-registrar_cbu error pl-1 font-bold w-full">{{$errors->first('registrar_cbu')}}</span>
                    @else
                        <span class="support support-box support-registrar_cbu error pl-1 font-bold w-full"></span>
                    @endif
        </div>
        <div class="flex items-center justify-center py-4">
            <a href="#step-1" class="step-button flex justify-center items-center btn btn-dos p-2 px-8 my-4 mr-2">
                <i class="step-icon fas fa-arrow-left mr-2"></i>
                <span class="text">Paso anterior</span>
            </a>
            <a href="#step-3" class="step-button step-2-button flex justify-center items-center btn btn-dos p-2 px-8 my-4 ml-2">
                <span class="text">Paso siguiente</span>
                <i class="step-icon fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>

    <div class="step step-3">
        <header>
            <h2 class="text-2xl text-center pt-8">Completa tus Datos</h2>
            <h3 class="text-1xl text-center pb-8">Tercer paso</h3>
        </header>
        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
            <input
                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="text" name="registrar_entidad" placeholder="Nombre de la entidad *" title="Campo obligatorio" value="{{old('registrar_entidad')}}">
                    @if($errors->has('registrar_entidad'))
                        <span class="support support-box support-registrar_entidad error pl-1 font-bold w-full">{{$errors->first('registrar_entidad')}}</span>
                    @else
                        <span class="support support-box support-registrar_entidad error pl-1 font-bold w-full"></span>
                    @endif
        </div>
        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
            <input
                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="text" name="registrar_cuit_cuil" placeholder="Cuit/Cuil" value="{{old('registrar_cuit_cuil')}}">
                    @if($errors->has('registrar_cuit_cuil'))
                        <span class="support support-box support-registrar_cuit_cuil error pl-1 font-bold w-full">{{$errors->first('registrar_cuit_cuil')}}</span>
                    @else
                        <span class="support support-box support-registrar_cuit_cuil error pl-1 font-bold w-full"></span>
                    @endif
        </div>
        <div class="mb-4 flex justify-center flex-wrap outline-none">
            <select class="form-input p-3 outline-none bg-white" name="registrar_provincia" title="Campo obligatorio">
                <option {{ !old('registrar_provincia') ? 'selected' : '' }} disabled>Provincia *</option>
            </select>
                    @if($errors->has('registrar_provincia'))
                        <span class="support support-box support-registrar_provincia error pl-1 font-bold w-full">{{$errors->first('registrar_provincia')}}</span>
                    @else
                        <span class="support support-box support-registrar_provincia error pl-1 font-bold w-full"></span>
                    @endif
        </div>
        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
            <label for="registrar_clave" class="ver-password">
                <i class="fas fa-eye"></i>
            </label>
            <input id="registrar_clave" name="registrar_clave" placeholder="Contraseña *" title="Campo obligatorio"
                class="form-input confirmation w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="password">
                    @if($errors->has('registrar_clave'))
                        <span class="support support-box support-registrar_clave error pl-1 font-bold w-full">{{$errors->first('registrar_clave')}}</span>
                    @else
                        <span class="support support-box support-registrar_clave error pl-1 font-bold w-full"></span>
                    @endif
        </div>
        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
            <label for="registrar_clave_confirmation" class="ver-password">
                <i class="fas fa-eye"></i>
            </label>
            <input id="registrar_clave_confirmation" name="registrar_clave_confirmation" placeholder="Repite tu contraseña"
                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="password">
                    @if($errors->has('registrar_clave_confirmation'))
                        <span class="support support-box support-registrar_clave_confirmation error pl-1 font-bold w-full">{{$errors->first('registrar_clave_confirmation')}}</span>
                    @else
                        <span class="support support-box support-registrar_clave_confirmation error pl-1 font-bold w-full"></span>
                    @endif
        </div>
        <div class="flex items-center justify-center pt-4 pb-2">
            <a href="#step-2" class="step-button flex justify-center items-center btn btn-dos p-2 px-8 mt-4 mb-2">
                <i class="step-icon fas fa-arrow-left mr-2"></i>
                <span class="text">Paso anterior</span>
            </a>
        </div>
        <div class="flex items-center justify-center pb-4 pt-2">
            <input class="form-submit registrar btn btn-dos p-2 px-8 mb-4 mt-2" type="submit" value="Registrate">
        </div>
    </div>
    {!! app('captcha')->display() !!}
    @if($errors->has('g-recaptcha-response'))
        <span class="support support-box support-g-recaptcha-response error pl-1 font-bold">{{$errors->first('g-recaptcha-response')}}</span>
    @else
        <span class="support support-box support-g-recaptcha-response error pl-1 font-bold"></span>
    @endif
    <div class="loguear text-center pb-8">
        <p>
            <span>¿Ya tenés cuenta?</span>
            <a class="change-view text text-tres" href="#ingresar">Inicia sesión</a>
        </p>
        <p>
            <a class="change-view text text-tres" href="#cambiar_clave">¿Olvidaste tu contraseña?</a>
        </p>
    </div>
</form>