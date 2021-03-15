<section id="tabla_usuarios" class="tab-content closed">
    <section class="accesos-directos w-full">
        <header class="py-8">
            <h2 class="text-center text-3xl">Listado de Usuarios</h2>
        </header>

        <main class="cards flex flex-wrap justify-around md:justify-center pt-8">
            <button data-name="id_nivel-todos" data-target="id_nivel"
                class="filter filter-button active clicked btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$niveles->total}}</span>
                </span>
                <span class="w-full">Usuarios Totales</span>
            </button>
            <button data-name="id_nivel-suscriptores" data-target="id_nivel" value="1"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$niveles->suscriptores}}</span>
                </span>
                <span class="w-full">Suscriptores</span>
            </button>
            <button data-name="id_nivel-administradores" data-target="id_nivel" value="2"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$niveles->administradores}}</span>
                </span>
                <span class="w-full">Administradores</span>
            </button>
        </main>

        <section class="actions flex justify-center py-4">
            <a href="/panel/usuario/crear"
                class="btn-rounded btn btn-uno-transparent font-bold py-2 px-4 flex justify-center items-center"><span
                    class="fas fa-plus text-3xl"></span></a>
        </section>
        <div class="buscador-box w-full py-4 flex justify-center items-center pt-4 mb-4">
            <div class="buscador">
                <label for="lupa-input"><i class="fas fa-search"></i></label>
                <input id="lupa-input" data-name="normativas-search" class="filter filter-search buscador-input outline-none" type="search" placeholder="Buscar">
            </div>
        </div>
    </section>

    <section class="table-data w-full max-w-full lg:max-w-none overflow-auto lg:overflow-hidden">
        <table class="table-auto w-full"></table>

        <div class="w-full flex justify-center my-8">
            <a href="#"
                class="filter-next agregar-10 btn btn-dosbtn btn-dos p-2 px-8 my-4 rounded text-white text-lg">Cargar
                más</a>
        </div>
    </section>
</section>
