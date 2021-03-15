@extends('layout.home')

@section('css')
	<link rel="stylesheet" href={{ asset('css/poncho/icono-arg.css') }}>
    <link href={{ asset('css/tw.css') }} rel="stylesheet"/>
    <link href={{ asset('submodules/NotificationJS/css/styles.css') }} rel="stylesheet">
    <link href={{ asset('css/auth/auth.css') }} rel="stylesheet"/>
@endsection

@section('nav')
    @component('components.nav.global', ['current' => 'inicio'])
    @endcomponent
@endsection

@section('title')
    Ingresar a Mutualcoop
@endsection

@section('main')
    <section class="authentication w-full">
        <header class="md:flex md:justify-center background background-ocho w-full flex-wrap">
            <section class="form-container mx-auto w-10/12 md:w-6/12 lg:w-5/12 px-6 py-12">
                @component('auth.components.ingresar', [
                    'validation' => $validation->ingresar,
                ])
                @endcomponent
                @component('auth.components.registrar', [
                    'obras' => $obras,
                    'validation' => $validation->registrar,
                ])
                @endcomponent
                @component('auth.components.cambiar_clave', [
                    'validation' => $validation->cambiar_clave,
                ])
                @endcomponent
            </section>
        </header>
    </section>
@endsection

@section('js')
    <script>
        @if(Session::has('status'))
        const status = @json(Session::get('status'));
        @endif
        const obras = @json($obras);
        let oldProvincia = @json(old('provincia'));
        const validation = @json($validation);
    </script>
    <script type="module" src={{asset('/js/auth/auth.js')}}></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection