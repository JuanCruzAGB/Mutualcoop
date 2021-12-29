@if((!$evento->privado || Route::current()->getName() == 'web.dashboard') && $evento->video)
    <a target="_blank" href="{{$evento->video}}" class="evento event-div border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-4 min-h-full relative">
@elseif((Route::current()->getName() == 'web.inicio') && $evento->video)
    <a href="/dashboard" class="evento event-div border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-4 min-h-full relative">
@else
    <a href="/#contacto" class="evento event-div border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-4 min-h-full relative">
@endif
    <header>
        <h3 class="eventos-card-header mt-4 px-4 text-2xl">{{$evento->titulo}}</h3>
        {{-- <span class="block mb-4 text-gray-600">{{$evento->fecha}}</span> --}}
        @if($evento->privado)
            <div class="private">
                <i class="icon fas fa-lock"></i>
            </div>
        @endif
    </header>
    <main class="eventos-card-image">
        @if(Storage::mimeType($evento->archivo) == 'image/jpeg' || Storage::mimeType($evento->archivo) == 'image/png')
            <figure>
                <img src='{{asset("/storage/$evento->archivo")}}' alt="Escritorio con una laptop">
            </figure>
        @endif

        <div class="evento-descripcion">
            <p class="py-4 text-gray-600">{!! $evento->descripcion !!}</p>
        </div>
    </main>
</a>