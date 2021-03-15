<main class="noticias flex flex-wrap justify-center">
    @if(count($noticias))
        @component('components.noticia.noticia', [
            'noticias' => $noticias,
        ])
        @endcomponent
    @else
        <section class="empty-noticia w-full md:w-6/12 lg:w-4/12">
            <div class="empty-img px-8"></div>
            <div class="my-4 px-12">
                <div class="empty-header"></div>
            </div>
            <main class="px-12 mb-8">
                <div class="empty-paragraph"></div>
            </main>
        </section>
    @endif
</main>