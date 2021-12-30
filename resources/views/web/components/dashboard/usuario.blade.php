<section id="dashboard_suscriptor" class="w-full justify-center">
    <section class="dashboard notificas flex flex-wrap justify-center items-center px-8">
        <header class="my-8">
            <h2 class="text text-uno text-center font-medium text-3xl mb-0">
                <span class="text">Noticias</span> 
            </h2>
        </header>
        @component('components.noticia.listado', [
            'noticias' => $noticias,
        ])
        @endcomponent
        <footer>
            <a href="/noticias" class="btn btn-dos px-4 py-2 rounded">Leer todas</a>
        </footer>
    </section>

    <section class="dashboard eventos_pasados flex flex-wrap justify-center items-center px-8">
        <header class="my-8">
            <h2 class="text text-uno text-center font-medium text-3xl mb-0">
                <span class="text">Eventos Pasados</span> 
            </h2>
        </header>
        @component('components.evento.listado_pasados', [
            'eventos' => $eventos_pasados,
            'showLink' => true,
        ])
        @endcomponent
    </section>
    
    <section class="accesos-directos w-full pt-8">
        <header>
            <h3 class="text-center font-medium text-3xl">
                <span class="text">Normativa</span> 
            </h3>
        </header>

        <main class="cards flex flex-wrap justify-around md:justify-center pt-8">
            <a href="/normativas/ley" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fas fa-gavel"></i>
                </span>
                <span class="w-full card-text">Ley</span>
            </a>
            <a href="/normativas/decreto" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fas fa-book-reader"></i>
                </span>
                <span class="w-full card-text">Decreto</span>
            </a>
            <a href="/normativas/resolucion" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="fas fa-book-open"></i>
                </span>
                <span class="w-full card-text">Resolución</span>
            </a>
        </main>
    </section>
    
    <section class="accesos-directos w-full md:pt-4">
        <header>
            <h3 class="text-center font-medium text-3xl">
                <span class="text">Gestión</span> 
            </h3>
        </header>

        <main class="cards flex flex-wrap justify-around md:justify-center pt-8">
            <a href="/gestiones/administrativo-contable" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fas fa-sort-numeric-up"></i>
                </span>
                <span class="w-full card-text">Administrativo Contable</span>
            </a>
            <a href="/gestiones/impositivo" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fas fa-percentage"></i>
                </span>
                <span class="w-full card-text">Impositivo</span>
            </a>
            <a href="/gestiones/previsional" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fas fa-briefcase"></i>
                </span>
                <span class="w-full card-text">Previsional</span>
            </a>
            <a href="/gestiones/recursos" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fas fa-folder-open"></i>
                </span>
                <span class="w-full card-text">Recursos</span>
            </a>
            <a href="/gestiones/analisis-de-la-reglamentacion" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fas fa-search"></i>
                </span>
                <span class="w-full card-text">Análisis de la Reglamentación</span>
            </a>
            <a href="/gestiones/informacion-complementaria" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fas fa-layer-group"></i>
                </span>
                <span class="w-full card-text">Información Complementaria</span>
            </a>
            <a href="/gestiones/jurisprudencia" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fas fa-code-branch"></i>
                </span>
                <span class="w-full card-text">Jurisprudencia</span>
            </a>
        </main>
    </section>
    
    <section class="accesos-directos w-full md:pt-4 md:pb-8">
        <header>
            <h3 class="text-center font-medium text-3xl">
                <span class="text">Otros</span> 
            </h3>
        </header>

        <main class="cards flex flex-wrap justify-around md:justify-center pt-8">
            <a target="_blank"
               href="https://www.afip.gob.ar/aplicativos/"
               class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fab fa-app-store"></i>
                </span>
                <span class="w-full card-text">Aplicativos vigente</span>
            </a>
            <a target="_blank"
               href="http://servicios.infoleg.gob.ar/infolegInternet/anexos/15000-19999/18462/texact.htm"
               class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fab fa-cuttlefish"></i>
                </span>
                <span class="w-full card-text">Ley de cooperativas</span>
            </a>
            <a target="_blank"
               href="http://servicios.infoleg.gob.ar/infolegInternet/anexos/25000-29999/25392/norma.htm"    
               class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fab fa-medium-m"></i>
                </span>
                <span class="w-full card-text">Ley de mutuales</span>
            </a>
            <a href="/notas-de-interes" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fas fa-rss"></i>
                </span>
                <span class="w-full card-text">Notas de Interés</span>
            </a>
        </main>
    </section>
</section>

    <!-- <section class="dashboard eventos_pasados bg-fixed banner flex flex-wrap justify-center items-center p-8">
        <header class="w-full">
            <h2 class="flex flex-wrap justify-center text-center text-white">
                <span class="text-big text-5xl">Próximos Eventos</span>
            </h2>
        </header>
    </section> -->

<section id="faq" class="faq w-full lg:w-8/12 lg:m-auto">
    <header class="my-8">
        <h2 class="text text-uno text-center font-medium text-3xl mb-0">
            <span>Preguntas frecuentes</span>
        </h2>
    </header>

    @component('components.pregunta.listado', [
        'preguntas' => $preguntas,
    ])
    @endcomponent
</section>

<section id="hace-tu-consulta" class="proximos-eventos w-full">
    <header class="my-8">
        <h2 class="text text-uno text-center text-3xl">
            <span class="text">Envia tu consulta</span> 
        </h2>
    </header>

    <main class="w-full my-8 px-8">
        @component('components.form.consulta', [
            'validation' => $validation,
        ])
        @endcomponent
    </main>
</section>