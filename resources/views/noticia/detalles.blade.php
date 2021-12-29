@extends('layout.home')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/poncho/icono-arg.css') }}">
  <link href={{ asset('css/slick/slick.css') }} rel="stylesheet" />
  <link href={{ asset('css/slick/slick-theme.css') }} rel="stylesheet" />
  <link href={{ asset('css/tw.css') }} rel="stylesheet" />
  <link href="{{ asset('css/noticia/detalles.css') }}" rel="stylesheet">
@endsection

@section('nav')
    @component('components.nav.panel', ['current' => 'inicio'])
    @endcomponent
@endsection

@section('title')
  {{$noticia->titulo}}
@endsection

@section('main')
    <section class="noticia flex-col w-full">
        <header class="lg:w-10/12 lg:mx-auto xl:w-8/12">
            <h2 class="text text-uno text-left font-medium text-3xl px-8 mt-8 mb-0">{{ $noticia->titulo }}</h2>
        </header>

        <div class="lg:w-10/12 lg:mx-auto xl:w-8/12 px-8 mt-4">
            <span class="noticia-fecha">{{$noticia->fecha}}</span>
        </div>
        
        <main class="w-full parallax grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 mt-8 md:mt-8 ">
            <a class="relative image-link lg:mt-8" target="_blank" href="{{ asset('/storage/' . $noticia->archivo) }}">
                <figure class="w-full mx-auto" style="background-image:url({{ asset('/storage/' . $noticia->archivo) }})">
                    <img class="noticia-imagen hidden" src="{{ asset('/storage/' . $noticia->archivo) }}" alt="foto de una noticia">
                </figure>
            </a>
            <header>
                <h3 class="px-8 my-8 md:mb-4 text-xl lg:pl-8 lg:text-xl text-left noticia-subtitulo">{{ $noticia->subtitulo}}</h3>
            </header>
            <p class="descripcion text-left text-xl px-8 md:mt-4">{!! nl2br($noticia->descripcion) !!}</p>
            <span class="px-6 my-8 fuente w-full text-left text-lg md:mb-8"><a href="{{ $noticia->fuente}}" target="_blank" class="cursor-pointer">{{ $noticia->fuente}}</a></span>
        </main>
    </section>
@endsection

@section('footer')
  @component('components.footer.global')
  @endcomponent
@endsection