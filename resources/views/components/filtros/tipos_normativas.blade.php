<div class="tipo_normativa">
    <h3 class="text-2xl text-center py-4">Filtrar por Tipo de Normativa</h3>

    <ul class="divide-y divide-gray-400 px-12">
        <li><button data-name="id_tipo_normativa-todos" data-target="id_tipo_normativa" class="filter filter-button active clicked block w-full text-left p-2">
            <span>Todos</span>
            <span class="flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text text-uno">{{$data->total}}</span>
        </button></li>
        <li><button data-name="id_tipo_normativa-ley" data-target="id_tipo_normativa" value=1 class="filter filter-button block w-full text-left p-2">
            <span>Ley</span>
            <span class="flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text text-uno">{{$data->ley}}</span>
        </button></li>
        <li><button data-name="id_tipo_normativa-decreto" data-target="id_tipo_normativa" value=2 class="filter filter-button block w-full text-left p-2">
            <span>Decreto</span> 
            <span class="flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text text-uno">{{$data->decreto}}</span>
        </button></li>
        <li><button data-name="id_tipo_normativa-resolucion" data-target="id_tipo_normativa" value=3 class="filter filter-button block w-full text-left p-2">
            <span>Resolución</span> 
            <span class="flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text text-uno">{{$data->resolucion}}</span>
        </button></li>
    </ul>   
</div>