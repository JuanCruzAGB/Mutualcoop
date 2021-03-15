<div class="tipo_suscripcion">
    <h3 class="text-2xl text-center py-4">Filtrar por Tipo de Suscripción</h3>

    <ul class="divide-y divide-gray-400 px-8">
        <li><button data-name="id_tipo_suscripcion-todos" data-target="id_tipo_suscripcion" class="filter filter-button active block w-full text-left p-2">
            <span>Todos</span>
            <span class="flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text text-uno">{{$data->total}}</span>
        </button></li>
        <li><button data-name="id_tipo_suscripcion-debito" data-target="id_tipo_suscripcion" value="2" class="filter filter-button block w-full text-left p-2">
            <span>Debito</span> 
            <span class="flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text text-uno">{{$data->debito}}</span>
        </button></li>
        <li><button data-name="id_tipo_suscripcion-semestral" data-target="id_tipo_suscripcion" value="2" class="filter filter-button block w-full text-left p-2">
            <span>Semestral</span> 
            <span class="flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text text-uno">{{$data->semestral}}</span>
        </button></li>
        <li><button data-name="id_tipo_suscripcion-anual" data-target="id_tipo_suscripcion" value="3" class="filter filter-button block w-full text-left p-2">
            <span>Anual</span> 
            <span class="flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text text-uno">{{$data->anual}}</span>
        </button></li>
    </ul>   
</div>