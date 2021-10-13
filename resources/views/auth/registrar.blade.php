@extends('layout.home')

@section('css')
	<link rel="stylesheet" href={{ asset('css/poncho/icono-arg.css') }}>
    <link href={{ asset('css/tw.css') }} rel="stylesheet"/>
    <link href={{ asset('submodules/NotificationJS/css/styles.css') }} rel="stylesheet">
    <link href={{ asset('css/auth/registrar.css') }} rel="stylesheet"/>
@endsection

@section('nav')
    @component('components.nav.global', ['current' => 'inicio'])
    @endcomponent
@endsection

@section('title')
    Registrarme en Mutualcoop
@endsection

@section('main')
    <section class="authentication w-full">
        <header class="md:flex md:justify-center background background-ocho w-full flex-wrap">
            <section class="form-container mx-auto w-10/12 md:w-6/12 lg:w-5/12 px-6 py-12">
                <form id="registrar" class="auth-form px-4 rounded-lg lg:px-4 rounded w-full bg-white" action="/registrar" method="post"
                data-rules="{{ json_encode($validation['registrar']['rules']) }}"
                data-messages="{{ json_encode($validation['registrar']['messages']) }}">
                @csrf
                    <div class="step step-1">
                        <header>
                            <h2 class="text-2xl text-center pt-8">Registro de Mutualcoop</h2>
                            <h3 class="text-1xl text-center pb-8">Primer paso</h3>
                        </header>
                        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                            <input name="nombre"
                                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" placeholder="Nombre *" title="Campo obligatorio" value="{{ old('nombre') }}">
                            @if ($errors->has('nombre'))
                                <span class="support support-box support-nombre error pl-1 font-bold w-full">{{ $errors->first('nombre') }}</span>
                            @else
                                <span class="support support-box support-nombre error pl-1 font-bold w-full"></span>
                            @endif
                        </div>
                        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                            <input name="correo"
                                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="email" placeholder="Correo *" title="Campo obligatorio" value="{{ old('correo') }}">
                            @if ($errors->has('correo'))
                                <span class="support support-box support-correo error pl-1 font-bold w-full">{{ $errors->first('correo') }}</span>
                            @else
                                <span class="support support-box support-correo error pl-1 font-bold w-full"></span>
                            @endif
                        </div>
                        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                            <input name="telefono"
                                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" placeholder="Télefono *" title="Campo obligatorio" value="{{ old('telefono') }}">
                            @if ($errors->has('telefono'))
                                <span class="support support-box support-telefono error pl-1 font-bold w-full">{{ $errors->first('telefono') }}</span>
                            @else
                                <span class="support support-box support-telefono error pl-1 font-bold w-full"></span>
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
                            <select class="form-input p-3 outline-none bg-white" name="id_tipo_suscripcion" title="Campo obligatorio">
                                <option {{ !old('id_tipo_suscripcion') ? 'selected' : '' }} disabled>Elige cada cuanto queres pagar *</option>
                                <option {{ old('id_tipo_suscripcion') == 1 ? 'selected' : '' }} value="1">Mensual</option>
                                <option {{ old('id_tipo_suscripcion') == 3 ? 'selected' : '' }} value="3">Anual</option>
                            </select>
                            @if ($errors->has('id_tipo_suscripcion'))
                                <span class="support support-box support-id_tipo_suscripcion error pl-1 font-bold w-full">{{ $errors->first('id_tipo_suscripcion') }}</span>
                            @else
                                <span class="support support-box support-id_tipo_suscripcion error pl-1 font-bold w-full"></span>
                            @endif
                        </div>
                        <div class="checkbox-obras w-8/12 mx-auto xl:w-8/12">
                            <ul class="obras my-8">
                                @foreach($obras as $obra)
                                    <li>
                                        @if (is_array(old('obras')) && in_array($obra->id_obra, old('obras')))
                                            <input value="{{ $obra->id_obra }}" class="form-input" name="obras[{{ $obra->slug }}]" checked id="{{ $obra->slug }}" type="checkbox">
                                        @else
                                            <input value="{{ $obra->id_obra }}" class="form-input" name="obras[{{ $obra->slug }}]" id="{{ $obra->slug }}" type="checkbox">
                                        @endif
                                        <label class="mt-2 obras" for="{{ $obra->slug }}">{{ $obra->nombre }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @if ($errors->has('obras'))
                            <span class="support support-box support-obras error pl-1 font-bold w-full">{{ $errors->first('obras') }}</span>
                        @else
                            <span class="support support-box support-obras error pl-1 font-bold w-full"></span>
                        @endif
                        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                            <input name="cbu" placeholder="CBU *" title="Campo obligatorio" value="{{ old('cbu') }}"
                                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="number">
                            @if ($errors->has('cbu'))
                                <span class="support support-box support-cbu error pl-1 font-bold w-full">{{ $errors->first('cbu') }}</span>
                            @else
                                <span class="support support-box support-cbu error pl-1 font-bold w-full"></span>
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
                                type="text" name="entidad" placeholder="Nombre de la entidad *" title="Campo obligatorio" value="{{ old('entidad') }}">
                            @if ($errors->has('entidad'))
                                <span class="support support-box support-entidad error pl-1 font-bold w-full">{{ $errors->first('entidad') }}</span>
                            @else
                                <span class="support support-box support-entidad error pl-1 font-bold w-full"></span>
                            @endif
                        </div>
                        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                            <input
                                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="cuit_cuil" placeholder="Cuit/Cuil" value="{{ old('cuit_cuil') }}">
                            @if ($errors->has('cuit_cuil'))
                                <span class="support support-box support-cuit_cuil error pl-1 font-bold w-full">{{ $errors->first('cuit_cuil') }}</span>
                            @else
                                <span class="support support-box support-cuit_cuil error pl-1 font-bold w-full"></span>
                            @endif
                        </div>
                        <div class="mb-4 flex justify-center flex-wrap outline-none">
                            <select class="form-input p-3 outline-none bg-white" name="provincia" title="Campo obligatorio">
                                <option {{ !old('provincia') ? 'selected' : '' }} disabled>Provincia *</option>
                            </select>
                            @if ($errors->has('provincia'))
                                <span class="support support-box support-provincia error pl-1 font-bold w-full">{{ $errors->first('provincia') }}</span>
                            @else
                                <span class="support support-box support-provincia error pl-1 font-bold w-full"></span>
                            @endif
                        </div>
                        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                            <label for="clave" class="ver-password">
                                <i class="fas fa-eye"></i>
                            </label>
                            <input id="clave" name="clave" placeholder="Contraseña *" title="Campo obligatorio"
                                class="form-input confirmation w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password">
                            @if ($errors->has('clave'))
                                <span class="support support-box support-clave error pl-1 font-bold w-full">{{ $errors->first('clave') }}</span>
                            @else
                                <span class="support support-box support-clave error pl-1 font-bold w-full"></span>
                            @endif
                        </div>
                        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                            <label for="clave_confirmation" class="ver-password">
                                <i class="fas fa-eye"></i>
                            </label>
                            <input id="clave_confirmation" name="clave_confirmation" placeholder="Repite tu contraseña"
                                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password">
                            @if ($errors->has('clave_confirmation'))
                                <span class="support support-box support-clave_confirmation error pl-1 font-bold w-full">{{ $errors->first('clave_confirmation') }}</span>
                            @else
                                <span class="support support-box support-clave_confirmation error pl-1 font-bold w-full"></span>
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
                    <div class="loguear text-center pb-8">
                        <p>
                            <span>¿Ya tenés cuenta?</span>
                            <a class="change-view text text-tres" href="/ingresar">Inicia sesión</a>
                        </p>
                        <p>
                            <a class="change-view text text-tres" href="/cambiar-clave">¿Olvidaste tu contraseña?</a>
                        </p>
                    </div>
                </form>
            </section>
        </header>
    </section>
@endsection

@section('js')
    <script>
        @if (Session::has('status'))
            const status = @json(Session::get('status'));
        @endif
        const obras = @json($obras);
        let oldProvincia = @json(old('provincia'));
        const validation = @json($validation);
    </script>
    <script type="module" src={{asset('/js/auth/registrar.js')}}></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection