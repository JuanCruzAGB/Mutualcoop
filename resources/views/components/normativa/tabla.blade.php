<section id="tabla_normativas" class="tab-content closed">
    <section class="accesos-directos w-full">
        <header class="py-8 flex justify-center items-center">
            <a href="/dashboard" class="floating-button sidebar-button open-btn btn btn-dos justify-center mr-4 py-2 left">
                <i class="sidebar-icon"></i>
                <span class="link-text">Volver</span>
            </a>
            <h2 class="text-center text-3xl inline">Listado de Normativas</h2>
            <a href="#filters" class="floating-button sidebar-button open-btn btn btn-dos justify-center ml-4 py-2 right justify-end">
				<i class="sidebar-icon fas"></i>
				<span class="link-text">Filtros</span>
			</a>
        </header>

        <div class="sub-secciones w-full flex justify-center">
            <a href="/panel/temas" class="sub-seccion-button temas-tab flex justify-center filter filter-button btn btn-dos px-4 py-2 rounded text-white my-4 text-lg">Temas</a>
        </div>

        <main class="cards flex flex-wrap justify-around md:justify-center pt-8">
            <button data-name="id_tipo_normativa-todos" data-target="id_tipo_normativa"
                class="filter filter-button active clicked btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$tipos->total}}</span>
                </span>
                <span class="w-full">Normativas Totales</span>
            </button>
            <button data-name="id_tipo_normativa-ley" data-target="id_tipo_normativa" value="1"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$tipos->ley}}</span>
                </span>
                <span class="w-full">Ley</span>
            </button>
            <button data-name="id_tipo_normativa-decreto" data-target="id_tipo_normativa" value="2"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$tipos->decreto}}</span>
                </span>
                <span class="w-full">Decreto</span>
            </button>
            <button data-name="id_tipo_normativa-resolucion" data-target="id_tipo_normativa" value="3"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$tipos->resolucion}}</span>
                </span>
                <span class="w-full">Resolución</span>
            </button>
        </main>

        <section class="actions flex justify-center py-4">
            <a href="/panel/normativa/crear" class="btn-rounded btn btn-uno-transparent font-bold py-2 px-4 flex justify-center items-center"><span class="fas fa-plus text-3xl"></span></a>
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

        <div class="w-full flex justify-center my-8">
            <button class="filter-next agregar-10 filter filter-button btn btn-dosfilter filter-button btn btn-dos p-2 px-8 my-4 rounded text-white text-lg">Cargar más</button>
        </div>
    </section>
</section>