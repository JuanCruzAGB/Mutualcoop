@extends('layout.home')

@section('css')
<link rel="stylesheet" href={{ asset('css/poncho/icono-arg.css') }}>
<link href={{ asset('css/tw.css') }} rel="stylesheet" />
<link href={{ asset('submodules/NotificationJS/css/styles.css') }} rel="stylesheet">
<link href={{ asset('css/auth/cambiar_clave.css') }} rel="stylesheet" />
@endsection

@section('nav')
@component('components.nav.global', ['current' => 'inicio'])
@endcomponent
@endsection

@section('title')
    Cambiar contraseña
@endsection

@section('main')
    <section class="authentication w-full">
        <header class="md:flex md:justify-center background background-seis w-full">
            <section class="form-container mx-auto w-10/12 md:w-6/12 lg:w-5/12 px-6">
                <form id="cambiar_clave" class="auth-form px-4 my-12 rounded-lg lg:px-4 rounded w-full bg-white"
                    action="/password/reset" method="post"
                    data-rules="{{ json_encode($validation['cambiar-clave']['rules']) }}"
                    data-messages="{{ json_encode($validation['cambiar-clave']['messages']) }}">
                    <h2 class="text-2xl text-center py-8">Recuperar contraseña</h2>
                    @csrf
                    <input type="hidden" name="token" class="form-input" value="{{ $password->token }}">
                    @if ($errors->has('token'))
                        <span class="support support-box support-token error pl-1 font-bold w-full">{{ $errors->first('token') }}</span>
                    @else
                        <span class="support support-box support-token error pl-1 font-bold w-full"></span>
                    @endif
                    <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                        <label color="text text-uno" for="verContra" class="ver-password">
                            <i class="fas fa-eye"></i>
                        </label>
                        <input id="verContra" class="form-input confirmation w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none"
                            type="password" name="clave" placeholder="Nueva contraseña *" title="Campo obligatorio">
                    @if ($errors->has('clave'))
                        <span class="support support-box support-clave error pl-1 font-bold w-full">{{ $errors->first('clave') }}</span>
                    @else
                        <span class="support support-box support-clave error pl-1 font-bold w-full"></span>
                    @endif
                    </div>
                    <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                        <label for="verContraConfirmada" class="ver-password">
                            <i class="fas fa-eye"></i>
                        </label>
                        <input id="verContraConfirmada" class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none"
                            type="password" name="clave_confirmation" placeholder="Repetir contraseña *" title="Campo obligatorio">
                    @if ($errors->has('clave_confirmation'))
                        <span class="support support-box support-clave_confirmation error pl-1 font-bold w-full">{{ $errors->first('clave_confirmation') }}</span>
                    @else
                        <span class="support support-box support-clave_confirmation error pl-1 font-bold w-full"></span>
                    @endif
                    </div>
                    <div class="flex items-center justify-center lg:justify-center py-4">
                        <input class="form-submit cambiar_clave btn btn-dos p-2 px-8 my-4" type="submit" value="Cambiar">
                    </div>
                    <div class="loguear text-center pb-8">
                        <p>
                            <a class="change-view text text-tres" href="/ingresar">Inicia sesión</a>
                        </p>
                        <p>
                            <span>¿No tenés cuenta?</span>
                            <a class="change-view text text-tres" href="/registrar">Registrate</a>
                        </p>
                    </div>
                </form>
            </section>
        </header>
    </section>
@endsection

@section('js')
    <script>
        const validation = @json($validation);
    </script>
    <script type="module" src={{asset('/js/auth/cambiar_clave.js')}}></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection
