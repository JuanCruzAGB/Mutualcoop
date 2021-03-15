<section id="tabla_suscriptores" class="tab-content closed">
    <section class="accesos-directos w-full">
        <header class="py-8">
            <h2 class="text-center text-3xl">Listado de Suscriptores</h2>
        </header>

        <main class="cards flex flex-wrap justify-around md:justify-center pt-8">
            <button
                data-name="id_tipo_suscripcion-todos" data-target="id_tipo_suscripcion"
                class="filter filter-button active clicked btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$suscripciones->total}}</span>
                </span>
                <span class="w-full">Suscriptores Totales</span>
            </button>
            <button data-name="id_tipo_suscripcion-debito" data-target="id_tipo_suscripcion" value="1"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$suscripciones->debito}}</span>
                </span>
                <span class="w-full">Débito</span>
            </button>
            <button data-name="id_tipo_suscripcion-semestral" data-target="id_tipo_suscripcion" value="2"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$suscripciones->semestral}}</span>
                </span>
                <span class="w-full">Semestral</span>
            </button>
            <button data-name="id_tipo_suscripcion-anual" data-target="id_tipo_suscripcion" value="3"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$suscripciones->anual}}</span>
                </span>
                <span class="w-full">Anual</span>
            </button>
        </main>

        <div class="buscador-box w-full py-4 flex justify-center items-center pt-4 mb-4">
            <div class="buscador">
                <label for="lupa-input"><i class="fas fa-search"></i></label>
                <input id="lupa-input" data-name="normativas-search" class="filter filter-search buscador-input outline-none" type="search" placeholder="Buscar">
            </div>
        </div>
    </section>

    <section class="table-data w-full max-w-full lg:max-w-none overflow-auto lg:overflow-hidden">
        <table class="table-auto w-full lg:w-10/12 mx-auto mt-8">
            <thead>
                <tr>
                    <th class="px-4 py-2 background background-tres text-white">N° de suscriptor</th>
                    <th class="px-4 py-2 background background-tres text-white">Correo</th>
                    <th class="px-4 py-2 background background-tres text-white">Nombre</th>
                    <th class="px-4 py-2 background background-tres text-white">Entidad</th>
                    <th class="px-4 py-2 background background-tres text-white">Telefono</th>
                    <th class="px-4 py-2 background background-tres text-white">Cuit/Cuil</th>
                    <th class="px-4 py-2 background background-tres text-white">Tipo de Suscripción</th>
                    <th class="px-4 py-2 background background-tres text-white">Obras Suscriptas</th>
                    <th class="px-4 py-2 background background-tres text-white"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-4 py-2 lg:whitespace-normal text-center">70053</td>
                    <td class="border px-4 py-2 lg:whitespace-normal text-center">coopca@nodosud.com.ar</td>
                    <td class="border px-4 py-2 lg:whitespace-normal text-center">Matías Fbbri
                    </td>
                    <td class="border px-4 py-2 lg:whitespace-normal text-center text-xs">AMSE EDUCACION PARA LA
                        LIBERTAD
                    </td>
                    <td class="border px-4 py-2 lg:whitespace-normal text-center">2995165799
                    </td>
                    <td class="border px-4 py-2 text-center whitespace-no-wrap">30-71457053-2
                    </td>
                    <td class="border px-4 py-2 lg:whitespace-normal text-center">Debito</td>
                    <td class="border px-4 py-2 lg:whitespace-normal text-center">Cooperativas Completas
                    </td>
                    <td class="border px-4 py-2 lg:whitespace-normal text-center"> <a href="#"><i
                                class="fas fa-eye text text-uno verBtn"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="w-full flex justify-center my-8">
            <a href="#"
                class="filter-next agregar-10 btn btn-dosbtn btn-dos p-2 px-8 my-4 rounded text-white text-lg">Cargar
                más</a>
        </div>
    </section>
</section>
