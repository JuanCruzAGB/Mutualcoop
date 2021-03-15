@foreach($preguntas as $pregunta)
    @if($pregunta->opened)
        <section class="pregunta opened mb-8 shadow-xs md:shadow-lg lg:shadow-lg">
    @else
        <section class="pregunta closed mb-8 shadow-xs md:shadow-lg lg:shadow-lg">
    @endif
        <a href="#respuesta-1" class="pregunta-titulo">
            <h3 class="text-xl text-gray-800 my-6 text-left px-8">{{$pregunta->pregunta}}</h3>
            @if($pregunta->opened)
                <i class="fas fa-minus ml-3 text-2xl pregunta-icono float-right relative"></i>
            @else
                <i class="fas fa-plus ml-3 text-2xl pregunta-icono float-right relative"></i>
            @endif
        </a>
        <hr class="separador-preguntas">
        <div id="respuesta-1" class="pregunta-respuesta px-8 overflow-hidden w-full my-4">
            <p class="text-gray-700 text-left pb-4">{{$pregunta->respuesta}}</p>
        </div>
    </section>
@endforeach