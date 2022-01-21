<section id="tabla_noticias" class="tab-content closed">
    <section class="accesos-directos w-full">
        <header class="pt-8 flex justify-center items-center">
            <a href="/dashboard" class="floating-button sidebar-button open-btn btn btn-dos justify-center mr-4 py-2 left">
                <i class="sidebar-icon"></i>
                <span class="link-text">Volver</span>
            </a>
            <h2 class="text-center text-3xl inline">Listado de Noticias</h2>
            <a href="#filters" class="floating-button sidebar-button open-btn btn btn-dos justify-center ml-4 py-2 right justify-end">
				<i class="sidebar-icon fas"></i>
				<span class="link-text">Filtros</span>
			</a>
        </header>

        <section class="actions flex justify-center py-4">
            <a href="/panel/noticia/crear" class="btn-rounded btn btn-uno-transparent font-bold py-2 px-4 flex justify-center items-center"><span class="fas fa-plus text-3xl"></span></a>
        </section>

        <div class="buscador-box w-full py-4 flex justify-center items-center pt-4 mb-4">
            <div class="buscador">
                <label for="lupa-input"><i class="fas fa-search"></i></label>
                <input id="lupa-input" data-name="normativas-search" class="filter filter-search buscador-input outline-none" type="search" placeholder="Buscar">
            </div>
        </div>
    </section>
    
    <section class="table-data w-full lg:w-10/12 lg:mx-auto max-w-full lg:max-w-none overflow-auto lg:overflow-hidden">
        <table class="table-auto w-full mb-8"></table>
    </section>
</section>