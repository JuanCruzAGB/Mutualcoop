<section id="tabla_temas" class="tab-content closed">
    <section class="accesos-directos w-full">
        <header class="pt-8 flex justify-center items-center">
            <a href="/dashboard" class="floating-button sidebar-button open-btn btn btn-dos left justify-center mr-4">
                <i class="sidebar-icon"></i>
                <span class="link-text">Volver</span>
            </a>
            <h2 class="text-center text-3xl inline">Listado de Temas</h2>
            <a href="#filters" class="floating-button sidebar-button open-btn btn btn-dos right justify-end justify-center ml-4">
				<i class="sidebar-icon fas"></i>
				<span class="link-text">Filtros</span>
			</a>
        </header>

        <section class="actions flex justify-center py-4">
            <a href="/panel/tema/crear" class="btn-rounded btn btn-uno-transparent font-bold py-2 px-4 flex justify-center items-center"><span class="fas fa-plus text-3xl"></span></a>
        </section>
        <div class="buscador-box w-full py-4 flex justify-center items-center pt-4 mb-4">
            <div class="buscador">
                <label for="lupa-input"><i class="fas fa-search"></i></label>
                <input id="lupa-input" data-name="normativas-search" class="filter filter-search buscador-input outline-none" type="search" placeholder="Buscar">
            </div>
        </div>
    </section>
    
    <section class="table-data w-full max-w-full lg:max-w-none overflow-auto lg:overflow-hidden">
        <table class="table-auto w-full lg:w-10/12 mx-auto mb-8"></table>

        <div class="w-full flex justify-center my-8">
            <a href="#" class="filter-next agregar-10 btn btn-dosbtn btn-dos p-2 px-8 my-4 rounded text-white text-lg">Cargar más</a>
        </div>
    </section>
</section>