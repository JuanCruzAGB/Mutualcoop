<main class="preguntas">
    @if(count($preguntas))
        @component('components.pregunta.pregunta_respuesta', [
            'preguntas' => $preguntas,
        ])
        @endcomponent
    @else
        <section class="empty-pregunta opened mb-8">
            <div class="flex justify-between px-8">
                <div class="empty-header"></div>
                <div class="empty-icon ml-3"></div>
            </div>
            <hr class="separador-preguntas">
            <div class="empty-respuesta px-8 my-4">
                <div class="empty-paragraph"></div>
            </div>
        </section>
    @endif
</main>