<section id="tabla_gestiones" class="tab-content closed">
    <section class="accesos-directos w-full">
        <header class="py-8 flex justify-center items-center">
            <a href="/dashboard" class="floating-button sidebar-button open-btn btn btn-seis left">
                <i class="sidebar-icon"></i>
                <span class="link-text">Volver</span>
            </a>
            <h2 class="text-center text-3xl inline">Listado de Gestiones</h2>
            <a href="#filters" class="floating-button sidebar-button open-btn btn btn-seis right justify-end">
				<i class="sidebar-icon fas"></i>
				<span class="link-text">Filtros</span>
			</a>
        </header>

        <div class="sub-secciones w-full flex justify-center">
            <a href="/panel/categorias" class="sub-seccion-button categorias-tab flex justify-center btn btn-dos px-4 py-2 rounded text-white my-4 text-lg">Categorias</a>
        </div>

        <main class="cards flex flex-wrap justify-around md:justify-center pt-8">
            <button data-name="id_tipo_gestion-todos" data-target="id_tipo_gestion"
                class="filter filter-button active clicked btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$tipos->total}}</span>
                </span>
                <span class="w-full">Gestiones Totales</span>
            </button>
            <button data-name="id_tipo_gestion-administrativo_contable" data-target="id_tipo_gestion" value="4"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$tipos->administrativo_contable}}</span>
                </span>
                <span class="w-full">Administrativo Contable</span>
            </button>
            <button data-name="id_tipo_gestion-impositivo" data-target="id_tipo_gestion" value="5"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$tipos->impositivo}}</span>
                </span>
                <span class="w-full">Impositivo</span>
            </button>
            <button data-name="id_tipo_gestion-previsional" data-target="id_tipo_gestion" value="6"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$tipos->previsional}}</span>
                </span>
                <span class="w-full">Previsional</span>
            </button>
            <button data-name="id_tipo_gestion-gestion_uif" data-target="id_tipo_gestion" value="7"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$tipos->gestion_uif}}</span>
                </span>
                <span class="w-full">Gestión UIF</span>
            </button>
            <button data-name="id_tipo_gestion-analisis_reglamentacion" data-target="id_tipo_gestion" value="8"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$tipos->analisis_reglamentacion}}</span>
                </span>
                <span class="w-full">Análisis de la Reglamentación</span>
            </button>
            <button data-name="id_tipo_gestion-informacion_complementaria" data-target="id_tipo_gestion" value="9"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$tipos->informacion_complementaria}}</span>
                </span>
                <span class="w-full">Información Complementaria</span>
            </button>
            <button data-name="id_tipo_gestion-jurisprudencia" data-target="id_tipo_gestion" value="10"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$tipos->jurisprudencia}}</span>
                </span>
                <span class="w-full">Jurisprudencia</span>
            </button>
        </main>

        <section class="actions flex justify-center py-4">
            <a href="/panel/gestion/crear" class="btn-rounded btn btn-uno-transparent font-bold py-2 px-4 flex justify-center items-center"><span class="fas fa-plus text-3xl"></span></a>
        </section>

        <div class="buscador-box w-full py-4 flex justify-center items-center pt-4 mb-4">
            <div class="buscador">
                <label for="lupa-input"><i class="fas fa-search"></i></label>
                <input id="lupa-input" data-name="normativas-search" class="filter filter-search buscador-input outline-none" type="search" placeholder="Buscar">
            </div>
        </div>
    </section>
    
    <section class="table-data w-full max-w-full lg:max-w-none overflow-auto lg:overflow-hidden">
        <table class="table-auto w-full mb-8"></table>

        <div class="w-full flex justify-center my-8">
            <a href="#" class="filter-next agregar-10 btn btn-dosbtn btn-dos p-2 px-8 my-4 rounded text-white text-lg">Cargar más</a>
        </div>
    </section>
</section>