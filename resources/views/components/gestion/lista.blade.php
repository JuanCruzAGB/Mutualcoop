<section id="gestiones" class="tab-content closed">
    <section class="accesos-directos w-full">
        <header class="py-8 flex justify-center items-center">
            <a href="/dashboard" class="floating-button sidebar-button open-btn btn btn-dos justify-center  py-2 mr-4 mb-8 left">
                <i class="sidebar-icon"></i>
                <span class="link-text">Volver</span>
            </a>
            <section>
                <h2 class="text-center text-3xl">Listado de Gestiones</h2>
                @if ($current != 'undefined')
                    <h3 class="text text-tres text-center text-2xl">{{ $current }}</h3>
                @endif
            </section>
            <a href="#filters" class="floating-button sidebar-button open-btn btn btn-dos justify-center ml-4 py-2 mb-8 right justify-end">
				<i class="sidebar-icon fas"></i>
				<span class="link-text">Filtros</span>
			</a>
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