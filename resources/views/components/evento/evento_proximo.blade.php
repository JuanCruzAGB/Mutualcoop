<section class="background background-cuatro evento w-full grid grid-cols-3 px-8 w-full md:w-5/12 mb-8 py-4 rounded-lg">
    <header class="fecha p-3 rounded-full h-20 w-20 flex items-center flex-wrap justify-center text-center relative">
        @if($evento->privado)
            <span class="private-text dia text-white text-3xl block text-center mb-1">{{date('d', strtotime($evento->fecha))}}</span>
            <span class="private-text mes text-white text-lg block text-center">{{$evento->mes}}</span>
            <div class="private">
                <i class="icon fas fa-lock"></i>
            </div>
        @else
            <span class="dia text-white text-3xl block text-center mb-1">{{date('d', strtotime($evento->fecha))}}</span>
            <span class="mes text-white text-lg block text-center">{{$evento->mes}}</span>
        @endif
    </header>
    <main class="w-full info-evento col-span-2">
        <h3 class="mb-2">{{$evento->titulo}}</h3>

        <p class="text-gray-600">{{$evento->descripcion}}</p>

        @if($evento->url_inscripcion)
            <div class="flex">
                <a target="_blank" href="{{$evento->url_inscripcion}}" class="btn btn-dos px-4 py-2 rounded text-white mt-4 text-lg">Inscribirme</a>
            </div>
        @else
            <div class="flex">
                <a href="/#contacto" class="btn btn-dos px-4 py-2 rounded text-white mt-4 text-lg">Inscribirme</a>
            </div>
        @endif
    </main>
</section>