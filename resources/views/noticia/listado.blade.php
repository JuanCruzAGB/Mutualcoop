@extends('layout.home')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/poncho/icono-arg.css') }}">
    <link href={{ asset('css/slick/slick.css') }} rel="stylesheet" />
    <link href={{ asset('css/slick/slick-theme.css') }} rel="stylesheet" />
    <link href={{ asset('css/tw.css') }} rel="stylesheet" />
    <link href="{{ asset('css/noticia/listado.css') }}" rel="stylesheet">
@endsection

@section('nav')
    @component('components.nav.global', ['current' => 'inicio'])
    @endcomponent
@endsection

@section('title')
    Noticias de Mutualcoop
@endsection

@section('main')
    <section class="noticias w-full md:w-10/12 md:m-auto bg-white">
        <header class="my-8">
            <h2 class="text text-uno text-center font-medium text-4xl mb-0">
                <span>Noticias</span>
            </h2>
        </header>

        @component('components.noticia.listado', [
            'noticias' => $noticias,
        ])
        @endcomponent
    </section>
@endsection

@section('js')
    <script type="module" src="{{asset('js/noticia/listado.js')}}"></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection