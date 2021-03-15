@extends('layout.home')

@section('css')
    <link href={{ asset('css/poncho/icono-arg.css') }} rel="stylesheet">
    <link href={{ asset('css/slick/slick.css') }} rel="stylesheet" />
    <link href={{ asset('css/slick/slick-theme.css') }} rel="stylesheet" />
    <link href={{ asset('css/tw.css') }} rel="stylesheet" />
    <link href="{{ asset('css/correo/gracias.css') }}" rel="stylesheet">
@endsection

@section('title')
    Gracias
@endsection

@section('nav')
    @component('components.nav.global', ['current' => 'inicio'])
    @endcomponent
@endsection

@section('main')
<section class="mt-8 gracias center-align mx-auto text-black flex flex-wrap w-full md:m-auto lg:mb-8 nosotros">


        <figure class="lg:w-6/12 md:bg-fixed nosotros-image-div md:w-full wow slideInLeft" data-wow-duration="1s"
            data-wow-delay="1s">
            <img class="w-full nosotros-image" src="/img/recursos/contacto.jpg" alt="contacto imagen">
        </figure>

        <main class="px-8 flex flex-col lg:w-6/12 flex justify-center mb-8 mb-8 wow slideInRight" data-wow-duration="1s"
            data-wow-delay="1s">
            <header class="w-full text-center mt-4">
              <h2 class="text-4xl">Muchas gracias por tu contacto</h2>
            </header>

            <main class="w-full text-center mt-8">
            <p class="text-2xl">Tan pronto cómo podamos nos estaremos comunicando.</p>
            <a href="/" class="p-2 text-center btn btn-dos mt-8">Volver a la web</a>
        </main>

    <!-- <div class="flex justify-center items-center flex-wrap px-4">
        <header class="w-full text-center mt-4">
              <h2 class="text-4xl">Muchas gracias por tu contacto</h2>
        </header>
        <main class="w-full text-center mt-8">
            <p class="text-2xl">Tan pronto cómo podamos nos estaremos comunicando.</p>
            <a href="/" class="p-2 text-center btn btn-dos mt-8">Volver a la web</a>
        </main>
    </div> -->
</section>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection