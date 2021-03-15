<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

        <!-- font -->

        <link href="https://fonts.googleapis.com/css2?family=Karla&family=Rubik&display=swap" rel="stylesheet">

        <!-- External repositories CSS -->
        <link href="{{ asset('/submodules/FloatingMenuJS/css/styles.css') }}" rel="stylesheet">

        <link href="{{ asset('submodules/DropdownJS/css/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('submodules/SidebarJS/css/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('submodules/NavMenuJS/css/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('submodules/TabMenuJS/css/styles.css') }}" rel="stylesheet">

        <!-- Layout CSS -->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('css/layout/home.css') }}" rel="stylesheet">

        <!-- Section CSS -->
        @yield('css')

        <title>@yield('title')</title>
    </head>
    <body>
        <header>
            @yield('nav')
        </header>
                
        <main class="main container-fluid">
            <div class="flex flex-col md:flex-row">
                @yield('main')
            </div>
        </main>

        <footer> 
            @yield('footer')
        </footer>

        <!-- Layout JS -->
        <script type="module" src={{asset('js/jquery-3.3.1.min.js')}}></script>
        <script type="module" src={{asset('js/layout/home.js')}}></script>

        @yield('js')
    </body>
</html>
