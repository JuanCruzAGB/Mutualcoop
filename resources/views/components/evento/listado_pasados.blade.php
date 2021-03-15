<main class="w-full">
    @if(count($eventos))
        <section class="slider eventos-slider mb-8 slick-slider">
            @foreach($eventos as $evento)
                @component('components.evento.evento_pasado', [
                    'evento' => $evento,
                    'showLink' => $showLink,
                ])
                @endcomponent
            @endforeach
        </section>
    @else
        <section class="my-8">
            <section class="empty-evento py-4 md:w-6/12 lg:w-4/12 xl:w-3/12 m-auto">
                <header>
                    <div class="empty-header"></div>
                </header>
                <main class="my-4">
                    <div class="empty-img"></div>
                    <div class="empty-paragraph"></div>
                </main>
            </section>
        </section>
    @endif
</main>