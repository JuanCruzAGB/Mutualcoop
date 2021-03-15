<section id="gestiones" class="tab-content closed">
    <section class="accesos-directos w-full">
        <header class="py-8">
            <h2 class="text-center text-3xl">Listado de Gestiones</h2>
            @if ($current != 'undefined')
                <h3 class="text text-tres text-center text-2xl">{{ $current }}</h3>
            @endif
        </header>

        <div class="buscador-box w-full py-4 flex justify-center items-center pt-4 mb-4">
            <div class="buscador">
                <label for="lupa-input"><i class="fas fa-search"></i></label>
                <input id="lupa-input" data-name="normativas-search" class="filter filter-search buscador-input outline-none" type="search" placeholder="Buscar">
            </div>
        </div>
    </section>
    
    <section class="w-8/12 mx-auto lista-data grid gap-4 grid-cols-2 my-12"></section>

    <div class="w-full flex justify-center my-8">
        <button class="filter-next agregar-10 filter filter-button btn btn-dosfilter filter-button btn btn-dos p-2 px-8 my-4 rounded text-white text-lg">Cargar más</button>
    </div>
</section>