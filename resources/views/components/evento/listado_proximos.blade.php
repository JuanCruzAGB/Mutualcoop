<main class="lg:w-9/12 lg:mx-auto flex flex-wrap justify-around">
    @foreach($eventos as $evento)
        @component('components.evento.evento_proximo', [
            'evento' => $evento,
            'showLink' => $showLink,
        ])
        @endcomponent
    @endforeach
</main>