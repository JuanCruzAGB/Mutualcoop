<section id="dashboard_administrador" class="w-full justify-center pt-8">
    <section class="stadistics bg-white w-full">
        <header>
            <h2 class="text text-uno text-center mb-8 font-medium text-4xl"> 
                <span>Dashboard</span>
            </h2>
        </header>
        
        <main class="flex flex-wrap justify-around md:justify-center text-sm bg-white mb-8">
            <section class="stadistic w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 p-4 mb-4 md:p-2 flex flex-wrap items-between border-solid shadow-md">
                <header class="w-full text-center text-gray-600">
                    <h3>Suscriptores Totales</h3>
                </header>
                <main class="w-full flex justify-center text-2xl md:text-4xl">
                    <div>{{$suscriptores->total->total}}</div>
                </main>
            </section>

            <section class="stadistic w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 p-4 mb-4 md:p-2 flex flex-wrap items-between border-solid shadow-md">
                <header class="w-full text-center text-gray-600">
                    <h3>Suscriptores Anuales</h3>
                </header>
                <main class="w-full flex justify-center text-2xl md:text-4xl">
                    <div>{{$suscriptores->anual->total}}</div>
                </main>
            </section>

            <section class="stadistic w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 p-4 mb-4 md:p-2 flex flex-wrap items-between border-solid shadow-md">
                <header class="w-full text-center text-gray-600">
                    <h3>Suscriptores Semestrales</h3>
                </header>
                <main class="w-full flex justify-center text-2xl md:text-4xl">
                    <div>{{$suscriptores->semestral->total}}</div>
                </main>
            </section>
            
            <section class="stadistic w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 p-4 mb-4 md:p-2 flex flex-wrap items-between border-solid shadow-md">
                <header class="w-full text-center text-gray-600">
                    <h3>Suscriptores por Debito</h3>
                </header>
                <main class="w-full flex justify-center text-2xl md:text-4xl">
                    <div>{{$suscriptores->debito->total}}</div>
                </main>
            </section>

            <section class="stadistic w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 p-4 mb-4 md:p-2 flex flex-wrap items-between border-solid shadow-md">
                <header class="w-full text-center text-gray-600">
                    <h3>Suscriptores de Cooperativas Completas</h3>
                </header>
                <main class="w-full flex justify-center text-2xl md:text-4xl">
                    <div>{{$suscriptores->cooperativas_completas->total}}</div>
                </main>
            </section>
            
            <section class="stadistic w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 p-4 mb-4 md:p-2 flex flex-wrap items-between border-solid shadow-md">
                <header class="w-full text-center text-gray-600">
                    <h3>Suscriptores de Cooperativas de Trabajo</h3>
                </header>
                <main class="w-full flex justify-center text-2xl md:text-4xl">
                    <div>{{$suscriptores->cooperativas_trabajo->total}}</div>
                </main>
            </section>

            <section class="stadistic w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 p-4 mb-4 md:p-2 flex flex-wrap items-between border-solid shadow-md">
                <header class="w-full text-center text-gray-600">
                    <h3>Suscriptores de Asociaciones Mutuales</h3>
                </header>
                <main class="w-full flex justify-center text-2xl md:text-4xl">
                    <div>{{$suscriptores->asociaciones_mutuales->total}}</div>
                </main>
            </section>
            
            <section class="stadistic w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 p-4 mb-4 md:p-2 flex flex-wrap items-between border-solid shadow-md">
                <header class="w-full text-center text-gray-600">
                    <h3>Suscriptores de UIF</h3>
                </header>
                <main class="w-full flex justify-center text-2xl md:text-4xl">
                    <div>{{$suscriptores->uif->total}}</div>
                </main>
            </section>
        </main>
    </section>

    <section class="accesos-directos w-full pt-8">
        <header>
            <h3 class="text-center font-medium text-3xl">Accesos Rápidos</h3>
        </header>

        <main class="cards flex flex-wrap justify-around md:justify-center pt-8">
            <a href="/panel/suscriptores" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fas fa-users"></i>
                </span>
                <span class="w-full card-text">Suscriptores</span>
            </a>
            <a href="/panel/facturaciones" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                <i class="icon fas fa-file-invoice-dollar"></i>
                </span>
                <span class="w-full card-text">Facturación</span>
            </a>
        </main>

        <main class="cards flex flex-wrap justify-around md:justify-center pt-8">
            <a href="/panel/eventos" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon far fa-calendar"></i>
                </span>
                <span class="w-full card-text">Eventos</span>
            </a>
            <a href="/panel/gestiones" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                <i class="icon fas fa-users-cog"></i>
                </span>
                <span class="w-full card-text">Gestión</span>
            </a>
            <a href="/panel/normativas" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                <i class="icon far fa-bookmark"></i>
                </span>
                <span class="w-full card-text">Normativa</span>
            </a>
            <a href="/panel/educaciones" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                <i class="icon fas fa-rss"></i>
                </span>
                <span class="w-full card-text">Notas de interés</span>
            </a>
            <a href="/panel/noticias" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon far fa-newspaper"></i>
                </span>
                <span class="w-full card-text">Noticias</span>
            </a>
            <a href="/panel/precios" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fas fa-money-check"></i>
                </span>
                <span class="w-full card-text">Precios</span>
            </a>
            <a href="/panel/preguntas" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fas fa-question"></i>
                </span>
                <span class="w-full card-text">Preguntas</span>
            </a>
            <a href="/panel/usuarios" class="btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <i class="icon fas fa-users"></i>
                </span>
                <span class="w-full card-text">Usuarios</span>
            </a>
        </main>
    </section>
</section>