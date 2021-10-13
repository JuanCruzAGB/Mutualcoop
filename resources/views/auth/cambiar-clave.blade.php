@extends('layout.home')

@section('css')
	<link rel="stylesheet" href={{ asset('css/poncho/icono-arg.css') }}>
    <link href={{ asset('css/tw.css') }} rel="stylesheet"/>
    <link href={{ asset('submodules/NotificationJS/css/styles.css') }} rel="stylesheet">
    <link href={{ asset('css/auth/cambiar-clave.css') }} rel="stylesheet"/>
@endsection

@section('nav')
    @component('components.nav.global', ['current' => 'inicio'])
    @endcomponent
@endsection

@section('title')
    Recuperar contraseña
@endsection

@section('main')
    <section class="authentication w-full">
        <header class="md:flex md:justify-center background background-ocho w-full flex-wrap">
            <section class="form-container mx-auto w-10/12 md:w-6/12 lg:w-5/12 px-6 py-12">
                <form id="cambiar-clave" class="auth-form px-4 rounded-lg lg:px-4 rounded w-full bg-white none" action="/cambiar-clave" method="post"
                data-rules="{{ json_encode($validation['cambiar-clave']['rules']) }}"
                data-messages="{{ json_encode($validation['cambiar-clave']['messages']) }}">
                    <h2 class="text-2xl text-center py-8">Recuperar contraseña</h2>
                    @csrf
                    <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                        <input name="dato"
                            class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Email o Número de Suscriptor *" title="Campo obligatorio">
                        @if ($errors->has('dato'))
                            <span class="support support-box support-dato error pl-1 font-bold w-full">{{ $errors->first('dato') }}</span>
                        @else
                            <span class="support support-box support-dato error pl-1 font-bold w-full"></span>
                        @endif
                    </div>
                    <div class="flex items-center justify-center lg:justify-center py-4">
                        <input class="form-submit cambiar-clave btn btn-dos p-2 px-8 my-4" type="submit" value="Enviar">
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
        @if (Session::has('status'))
            const status = @json(Session::get('status'));
        @endif
        const validation = @json($validation);
    </script>
    <script type="module" src={{asset('/js/auth/cambiar-clave.js')}}></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection