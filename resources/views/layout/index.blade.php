<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NBVHHKG');</script>
        <!-- End Google Tag Manager -->
        <!-- Start of HubSpot Embed Code -->
        <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/6281339.js"></script>
        <!-- End of HubSpot Embed Code -->
        <!-- no-cache -->
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link href="{{ asset('css/layout/index.css') }}" rel="stylesheet">
        {{-- <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.css') }}"  media="screen,projection"/> --}}
        <link href="https://fonts.googleapis.com/css2?family=Karla&family=Rubik&display=swap" rel="stylesheet">
        <!-- <link href="{{ asset('css/main.css') }}" rel="stylesheet"> -->
        @yield('css')

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <title>@yield('titulo')</title>
    </head>

    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBVHHKG"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <header>
            <nav class="nav-extended no-logueado">
                <div class="nav-wrapper">
                    <a href="/" class="brand-logo">Mutualcoop</a>
                    @if(!Auth::check())
                        <button class="btn-small iniciarIndex">Ingresar</button>
                    @endif
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="ul-nav right hide-on-med-and-down">
                        @if(URL::current() == url(''))
                            <li class="active"><a href="/">Inicio</a></li>
                        @else
                            <li><a href="/">Inicio</a></li>
                        @endif
                        <li><a href="/#obras">Obras</a></li>
                        <li><a href="/#noticias">Noticias</a></li>
                        <li><a href="/#eventos">Agenda</a></li>
                        <li><a href="/#contacto">Contacto</a></li>
                        @if(Auth::check())
                            @if(URL::current() == url('/suscripciones'))
                                <li class="active"><a href="/suscripciones">Suscripciones</a></li>
                            @else
                                <li><a href="/suscripciones">Suscripciones</a></li>
                            @endif
                            @if(Auth::user()->id_nivel == 2)
                                @if(URL::current() == url('/panel'))
                                    <li class="active"><a href="/panel">Panel</a></li>
                                @else
                                    <li><a href="/panel">Panel</a></li>
                                @endif
                            @endif
                            <li><a href="/salir">Cerrar sesión</a></li>
                        @endif
                    </ul>
                </div>
                <ul class="sidenav red lighten-2" id="mobile-demo">
                    @if(URL::current() == url(''))
                        <li class="active"><a href="/">Inicio</a></li>
                    @else
                        <li><a href="/">Inicio</a></li>
                    @endif
                    <li><a href="/#obras">Obras</a></li>
                    <li><a href="/#noticias">Noticias</a></li>
                    <li><a href="/#eventos">Agenda</a></li>
                    <li><a href="/#contacto">Contacto</a></li>
                    @if(Auth::check())
                        @if(URL::current() == url('/suscripciones'))
                            <li class="active"><a href="/suscripciones">Suscripciones</a></li>
                        @else
                            <li><a href="/suscripciones">Suscripciones</a></li>
                        @endif
                        @if(Auth::user()->id_nivel == 2)
                            @if(URL::current() == url('/panel'))
                                <li class="active"><a href="/panel">Panel</a></li>
                            @else
                                <li><a href="/panel">Panel</a></li>
                            @endif
                        @endif
                        <li><a href="/salir">Cerrar sesión</a></li>
                    @endif
                </ul>
                @yield('nav')
            </nav>
        </header>
		      
        <main>
            @if(Session::has('status'))
                <div id="notificacion">
                    <p>{{ Session::get('status') }}</p>
                    <i class="material-icons">close</i>
                </div>
            @endif

            {{-- muestra de errores del login --}}

            @yield('main')
        </main>

        <footer> 
            @yield('footer')
        </footer>
       
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('js/materialize.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
      
        @if(!Auth::check())
            <script type="text/javascript" src="{{ asset('js/web/ingresarBtn.js') }}"></script>
        @endif
        @yield('js')
    </body>
</html>