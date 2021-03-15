<section id="tabla_facturaciones" class="tab-content closed">
    <section class="accesos-directos w-full">
        <header class="py-8">
            <h2 class="text-center text-3xl">Listado de Facturaciones</h2>
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
            <button
                data-name="id_tipo_suscripcion-semestral" data-target="id_tipo_suscripcion" value="2"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$suscripciones->semestral}}</span>
                </span>
                <span class="w-full">Semestral</span>
            </button>
            <button
                data-name="id_tipo_suscripcion-anual" data-target="id_tipo_suscripcion" value="3"
                class="filter filter-button btn btn-dos-transparent border acceso-directo w-5/12 md:w-2/12 lg:h-40 lg:w-40 mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6 xl:mx-4 border-solid shadow-md bg-white text-center flex justify-center items-center flex-wrap rounded py-2">
                <span class="text-3xl w-full">
                    <span>{{$suscripciones->anual}}</span>
                </span>
                <span class="w-full">Anual</span>
            </button>
        </main>

        <div class="mes mb-8 md:mx-4 md:mb-4 lg:mx-6 lg:mb-6">
            <h3 class="text-2xl text-center py-4">Filtrar por mes</h3>
        
            <div class="flex justify-around">
                <div class="arrow">
                    <button value="{{'(-' . date('m', strtotime('-1 month', strtotime(date('Y-m-d')))) . '-)'}}" class="fecha fecha-left p-2 btn btn-dos left no-text arrow prev">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </div>
        
                <select data-name="fecha-select" data-target="alta" class="filter filter-select filter-regexp outline-none text-xl p-2">
                    <option @if(date('m') == '01') selected @endif value="(-01-)">Enero</option>
                    <option @if(date('m') == '02') selected @endif value="(-02-)">Feberero</option>
                    <option @if(date('m') == '03') selected @endif value="(-03-)">Marzo</option>
                    <option @if(date('m') == '04') selected @endif value="(-04-)">Abril</option>
                    <option @if(date('m') == '05') selected @endif value="(-05-)">Mayo</option>
                    <option @if(date('m') == '06') selected @endif value="(-06-)">Junio</option>
                    <option @if(date('m') == '07') selected @endif value="(-07-)">Julio</option>
                    <option @if(date('m') == '08') selected @endif value="(-08-)">Agosto</option>
                    <option @if(date('m') == '09') selected @endif value="(-09-)">Septiembre</option>
                    <option @if(date('m') == '10') selected @endif value="(-10-)">Octubre</option>
                    <option @if(date('m') == '11') selected @endif value="(-11-)">Noviembre</option>
                    <option @if(date('m') == '12') selected @endif value="(-12-)">Diciembre</option>
                </select>
        
                <div class="arrow">
                    <button value="{{'(-' . date('m', strtotime('+1 month', strtotime(date('Y-m-d')))) . '-)'}}" class="fecha fecha-right p-2 btn btn-dos right no-text arrow next">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
    
    <section class="table-data w-full max-w-full lg:max-w-none overflow-auto lg:overflow-hidden">
        <table class="table-auto w-full lg:w-10/12 mx-auto mb-8"></table>
    </section>
</section>