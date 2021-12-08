@extends('layout.panel')

@section('css')
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link href={{ asset('css/poncho/icono-arg.css') }} rel="stylesheet" >
    <link href={{ asset('css/slick/slick.css') }} rel="stylesheet" />
    <link href={{ asset('css/slick/slick-theme.css') }} rel="stylesheet" />
    <link href={{ asset('css/tw.css') }} rel="stylesheet" />
    <link href={{ asset('submodules/NotificationJS/css/styles.css') }} rel="stylesheet">
    <link href={{ asset('css/web/dashboard.css') }} rel="stylesheet">
@endsection

@section('nav')
    @component('components.nav.panel', ['current' => 'panel'])
    @endcomponent
@endsection

@section('title')
    Dashboard
@endsection

@section('main')
    @if($usuario->estado > 2)
        @if($usuario->id_nivel > 1)
            @component('web.components.dashboard.administrador', [
                'suscriptores' => $suscriptores,
            ])
            @endcomponent

            <aside id="suscriptor" class="separator separator-uno pb-8 md:py-8">
                <section class="m-auto w-7/12 md:w-5/12 lg:w-3/12 xl:w-2/12">
                    <main>
                        <p class="text-white text-center uppercase">Dashboard Suscriptor</p>
                    </main>
                </section>
            </aside>

        @endif
        @component('web.components.dashboard.usuario', [
            'eventos_pasados' => $eventos_pasados,
            'noticias' => $noticias,
            'preguntas' => $preguntas,
            'validation' => $validation,
        ])
        @endcomponent
    @elseif($usuario->estado > 1)
        <section id="dashboard" class="w-full justify-center">
            <h2 class="text-center mt-8 text-3xl">Bienvenido a Mutualcoop</h2>
            <p class="lg:w-6/12 text-center mt-8 lg:mx-auto">Su usuario está pendiente de aprobación, muy pronto nos pondremos en contacto.<br />Cualquier asunto puede enviarnos un email a info@mutualcoop.org.ar.</p>
        </section>
    @else
        <section id="dashboard" class="w-full justify-center">
            <h2 class="text-center mt-8 text-3xl">Bienvenido a Mutualcoop</h2>
            <p class="lg:w-6/12 text-center mt-8 lg:mx-auto">Acabamos de enviar un email a la casilla que acaba de registrar. Por favor revise la bandeja de entrada o SPAM para confirmar que el correo electrónico es correcto.</p>
        </section>
    @endif
@endsection

@section('js')
    <script>
        const suscriptions = @json($suscriptions);
        const validation = @json($validation);
        @if(Session::has('status'))
        const status = @json(Session::get('status'));
        @endif
    </script>
    <script type="module" src={{ asset('js/jquery-3.3.1.min.js') }}></script>
    <script type="module" src={{ asset('js/slick.js') }}></script>
    <script type="module" src={{ asset('js/web/dashboard.js') }}></script>
    <script type="module" src="{{ asset('js/pregunta/faq-privadas.js') }}"></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection