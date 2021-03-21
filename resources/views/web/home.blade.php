@extends('layout.home')

@section('css')
<link href={{ asset('css/poncho/icono-arg.css') }} rel="stylesheet">
<link href={{ asset('css/flickity.css') }} rel="stylesheet">
<link href={{ asset('css/slick/slick.css') }} rel="stylesheet" />
<link href={{ asset('css/slick/slick-theme.css') }} rel="stylesheet" />
<link href={{ asset('css/tw.css') }} rel="stylesheet" />
<link href={{ asset('css/animate/animate.css') }} rel="stylesheet" />
<link href={{ asset('submodules/NotificationJS/css/styles.css') }} rel="stylesheet">
<link href={{ asset('css/web/home.css') }} rel="stylesheet">
@endsection

@section('nav')
@component('components.nav.home', ['current' => 'inicio'])
@endcomponent
@endsection

@section('title')
Mutualcoop
@endsection

@section('main')
<section class="w-full">
    <section class="bg-fixed banner flex flex-wrap justify-center items-center wow fadeIn" data-wow-delay="1">
        <div class="w-full flex flex-wrap justify-center">
            <h2 class="flex flex-wrap justify-center text-center text-white px-4">
                <span class="w-full text-4xl bannerText">Asesoramos y acompañamos Cooperativas y Mutuales de todo el
                    país</span>
            </h2>

            <div class="w-full flex justify-center">
                <a href="#nosotros"
                    class="justify-center items-center btn btn-dos px-4 py-2 rounded text-white text-lg bannerBtn mt-3">Sobre
                    nosotros</a>
            </div>
        </div>
    </section>

    <section id="nosotros"
        class="text-black flex flex-wrap w-full md:m-auto lg:mb-8 nosotros background background-cuatro">
        <header class="my-8 w-full">
            <h2 class="text-black text-center font-medium text-4xl mb-0">
                <span class="wow slideInLeft" data-wow-delay="5" data-wow-duration="5">Sobre Nosotros</span>
            </h2>
        </header>

        <figure class="lg:w-6/12 md:bg-fixed nosotros-image-div md:w-full wow slideInLeft" data-wow-duration="1s"
            data-wow-delay="1s">
            <img class="w-full nosotros-image" src="/img/recursos/nosotros-image.jpg" alt="Sobre nosotros imagen">
        </figure>

        <main class="px-8 flex flex-col lg:w-6/12 flex justify-center mb-8 mb-8 wow slideInRight" data-wow-duration="1s"
            data-wow-delay="1s">
            <p class="pt-4">Desde 1967 nos dedicamos a asesorar empresas de la economía social a través de nuestras
                suscripciones. Contamos con un equipo de profesionales en todas las áreas y junto a ellos damos soporte
                a más de 500 entidades a lo largo de todo el país.</p>

            <div class="w-full flex justify-center">
                <a target="_blank" href="http://landing.mutualcoop.org.ar/"
                    class="btn btn-dos px-4 py-2 rounded text-white text-lg nosotrosBtn justify-center items-center mt-4">Más
                    información</a>
            </div>
        </main>
    </section>

    <!-- <aside class="separator separator-dos py-8">
            <section class="w-full md:6/12 mb-4">
                <header>
                    <h2 class="text text-dos text-center uppercase">Siguenos en nuestras redes sociales</h2>
                </header>
            </section>
            <section class="w-full md:6/12">
                <main class="flex justify-center">
                    <a class="btn btn-dos-transparent py-2 w-5/12 lg:w-1/12 inline-flex flex-wrap lg:mr-4" href="#">
                        <i class="icon w-full flex justify-center fab fa-instagram text-4xl text-center"></i>
                        <span class="text w-full flex justify-center">@Mutualcoop</span>
                    </a>
                    
                    <a class="btn btn-dos-transparent py-2 w-5/12 lg:w-1/12 inline-flex flex-wrap lg:ml-4" href="#">
                        <i class="icon w-full flex justify-center fab fa-youtube text-4xl text-center"></i>
                        <span class="text w-full flex justify-center">Mutualcoop</span>
                    </a>
                </main>
            </section>
        </aside> -->

    <section id="servicios" class="servicios w-full md:m-auto background bg-white">
        <header class="my-8">
            <h2 class="text text-uno text-center font-medium text-4xl mb-0">
                <span>Nuestro Servicios</span>
            </h2>
        </header>

        @component('components.servicio.listado')
        @endcomponent
    </section>

    <!-- <section class="noticias w-full md:w-10/12 md:m-auto bg-white">
            <header class="my-8">
                <h2 class="text text-uno text-center font-medium text-4xl mb-0">
                    <span>Últimas Noticias</span>
                </h2>
            </header>

            @component('components.noticia.listado', [
                'noticias' => $noticias,
            ])
            @endcomponent
        </section> -->

    <section class="suscriptores">
        <h2 class="text text-uno text-center font-medium text-4xl mb-0">Algunos de nuestros suscriptores</h2>

        <div class="slider suscriptores-slider background bg-white wow fadeInDown padre-suscriptores" data-wow-duration="1s"
            data-wow-delay="1s">
            <div class="text-center">
                <img src="{{asset ('img/suscriptores/RN.png')}}" alt="Gobierno de Río Negro">
            </div>
            <div class="text-center">
                <img src="{{asset ('img/suscriptores/inaes.jpg')}}"
                    alt="Instituto nacional de asociativismo y economia social">
            </div>
            <div class="text-center">
                <img src="{{asset ('img/suscriptores/consejo-profesional.png')}}"
                    alt="Consejo profesional de Ciencias Económicas">
            </div>
            <div class="text-center">
                <img src="{{asset ('img/suscriptores/gob-prov-salta.png')}}" alt="Gobierno de de la provincia de salta">
            </div>
            <div class="text-center">
                <img src="{{asset ('img/suscriptores/cotesma.png')}}"
                    alt="Cooperativa telefónica de San Martín de los Andés">
            </div>
    </section>

    <section id="eventos" class="w-full mt-8 lg:mb-8 background background-cuatro wow fadeInDown" data-wow-duration="1s"
        data-wow-delay="1s">
        @if(count($eventos_proximos))
        <section class="eventos_proximos w-full">
            <header class="my-8">
                <h2 class="text-black text-center font-medium text-4xl mb-0 pt-4">
                    <span>Próximos Eventos</span>
                </h2>
            </header>

            @component('components.evento.listado_proximos', [
            'eventos' => $eventos_proximos,
            'showLink' => false,
            ])
            @endcomponent
        </section>
        @endif

        <section class="eventos_pasados flex flex-wrap justify-center items-center p-8">
            <header class="my-8">
                <h2 class="flex flex-wrap justify-center text-center text-white">
                    <span class="text-black text-center font-medium text-4xl mb-0 pt-4">Eventos Pasados</span>
                </h2>
            </header>

            @component('components.evento.listado_pasados', [
            'eventos' => $eventos_pasados,
            'showLink' => false,
            ])
            @endcomponent
        </section>
    </section>

    <!-- <aside class="separator separator-dos py-8">
            <section class="w-full md:6/12 mb-4">
                <header>
                    <h2 class="text text-dos text-center uppercase">No te pierdas ningúna novedad</h2>
                </header>
            </section>
            <section class="w-full md:6/12">
                <main class="flex justify-center">
                    <div class="w-full flex justify-center">
                        <a href="#contacto" class="btn btn-uno px-4 py-2 rounded text-white text-lg">Suscribite al NewsLetter</a>
                    </div>
                </main>
            </section>
        </aside> -->

    <section id="faq" class="faq w-full lg:w-4/12 lg:m-auto lg:mb-16">
        <header class="my-8">
            <h2 class="text text-uno text-center font-medium text-4xl mb-0">
                <span>Preguntas Frecuentes</span>
            </h2>
        </header>

        @component('components.pregunta.listado', [
        'preguntas' => $preguntas,
        ])
        @endcomponent
    </section>


    <section id="contacto" class="contacto wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
        <div
            class="w-full max-w-xs md:max-w-md lg:max-w-none mx-auto mb-8 lg:grid lg:grid-cols-2 lg:gap-4 lg:px-8 xl:px-40">
            <div class="info-mapa mt-4 mb-4 lg:mt-0 lg:px-4 text-center">
                <h2 class="text-4xl">Contacto</h2>
                <p class="my-4 text-md">Para más información completá el formulario para que alguien del equipo se
                    comunique con vos.</p>
                <div class="grid grid-cols-2 my-8">
                    <div class="mx-auto flex justify-center flex-wrap">
                        <a>
                            <i class="icono-arg-marcador-ubicacion-1 text-4xl text-blue-800"></i>
                        </a>
                        <a class="text-center w-full text-lg">Ubicación:</a>
                        <p class="text-center w-full text-md">CABA, Buenos Aires</p>
                    </div>
                    <div class="mx-auto flex justify-center flex-wrap">
                        <span>
                            <i class="icono-arg-telefono-lineal text-4xl text-blue-800 mt-4"></i>
                        </span>
                        <p class="text-center w-full text-lg">Telefono:</p>
                        <p class="text-center w-full text-md">+54 9 11-6717-2626</p>
                    </div>
                </div>
            </div>

            @component('components.form.contacto',[
            'validation' => $validation,
            ])
            @endcomponent
        </div>
    </section>
</section>

<aside class="floating-menu bottom right">
    <a target="_blank" href="https://wa.me/5491167172626" class="floating-button whatsapp">
        <i class="fab fa-whatsapp"></i>
    </a>
</aside>
@endsection

@section('js')
<script src='https://www.google.com/recaptcha/api.js'></script>
{!! no_captcha()->script() !!}
<script>
    @if(Session::has('status'))
    const status = @json(Session::get('status'));
    @endif
    const validation = @json($validation);
</script>
<script src={{ asset('js/wow/wow.min.js') }}></script>
<script type="module" src={{ asset('js/jquery-3.3.1.min.js') }}></script>
<script type="module" src={{ asset('js/slick.js') }}></script>
<script type="module" src={{ asset('js/flickity.pkgd.min.js') }}></script>
<script type="module" src={{ asset('js/web/home.js') }}></script>
<script>
    wow = new WOW({
        mobile: false
    })
    wow.init();

</script>
@endsection

@section('footer')
@component('components.footer.global')
@endcomponent
@endsection