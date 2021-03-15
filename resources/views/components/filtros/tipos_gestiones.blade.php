<div class="tipo_gestion">
    <h3 class="text-2xl text-center py-4">Filtrar por Tipo de Gestión</h3>

    <ul class="divide-y divide-gray-400 px-8">
        <li><button data-name="id_tipo_gestion-todos" data-target="id_tipo_gestion" class="filter filter-button active clicked block w-full text-left p-2">
            <span>Todos</span>
            <span class="background background-tres flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text-white">{{$data->total}}</span>
        </button></li>
        <li><button data-name="id_tipo_gestion-administrativo_contable" data-target="id_tipo_gestion" value=4 class="filter filter-button block w-full text-left p-2">
            <span>Administrativo Contable</span>
            <span class="background background-tres flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text-white">{{$data->administrativo_contable}}</span>
        </button></li>
        <li><button data-name="id_tipo_gestion-impositivo" data-target="id_tipo_gestion" value=5 class="filter filter-button block w-full text-left p-2">
            <span>Impositivo</span>
            <span class="background background-tres flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text-white">{{$data->impositivo}}</span>
        </button></li>
        <li><button data-name="id_tipo_gestion-previsional" data-target="id_tipo_gestion" value=6 class="filter filter-button block w-full text-left p-2">
            <span>Previsional</span>
            <span class="background background-tres flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text-white">{{$data->previsional}}</span>
        </button></li>
        <li><button data-name="id_tipo_gestion-recursos" data-target="id_tipo_gestion" value=7 class="filter filter-button block w-full text-left p-2">
            <span>Recurso</span>
            <span class="background background-tres flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text-white">{{$data->recursos}}</span>
        </button></li>
        <li><button data-name="id_tipo_gestion-analisis_reglamentacion" data-target="id_tipo_gestion" value=8 class="filter filter-button block w-full text-left p-2">
            <span>Análisis de la Reglamentación</span>
            <span class="background background-tres flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text-white">{{$data->analisis_reglamentacion}}</span>
        </button></li>
        <li><button data-name="id_tipo_gestion-informacion_complementaria" data-target="id_tipo_gestion" value=9 class="filter filter-button block w-full text-left p-2">
            <span>Información Complementaria</span>
            <span class="background background-tres flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text-white">{{$data->informacion_complementaria}}</span>
        </button></li>
        <li><button data-name="id_tipo_gestion-jurisprudencia" data-target="id_tipo_gestion" value=10 class="filter filter-button block w-full text-left p-2">
            <span>Jurisprudencia</span>
            <span class="background background-tres flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text-white">{{$data->jurisprudencia}}</span>
        </button></li>
    </ul>
</div>