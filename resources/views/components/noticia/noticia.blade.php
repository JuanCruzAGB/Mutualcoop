@foreach($noticias as $noticia)
    <section class="noticia w-full md:w-6/12 lg:w-4/12">
        <figure class="noticia-img mb-4 mx-8">
            <img src="/storage/{{$noticia->archivo}}" alt="{{$noticia->titulo}}">
        </figure>
        <header class="mb-4">
            <h3 class="text-center text-xl lg:w-11/12">{{$noticia->titulo}}</h3>
        </header>
        <main class="px-12">
            <p class="text-gray-600">{{$noticia->subtitulo}}</p>

            <div class="flex justify-center">
                <a href="/noticia/{{$noticia->slug}}" class="btn btn-dos-transparent px-4 py-2 rounded text-white mt-4 mb-8 text-lg">Ver más</a>
            </div>
        </main>
    </section>
@endforeach
@if(count($noticias) > 6)
    <div class="flex justify-center w-full mb-8">
        <button class="filter-next next-button btn btn-uno flex justify-center px-4 py-2">Cargar más</button>
    </div>
@else
    <div class="flex justify-center w-full mb-8">
        {{-- <p class="text-gray-600">No se encontraron resultados</p> --}}
    </div>
@endif