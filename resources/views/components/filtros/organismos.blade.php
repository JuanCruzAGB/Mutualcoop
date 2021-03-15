<div class="organismo">
    <h3 class="text-2xl text-center py-4">Filtrar por Organismo</h3>
    
    <ul class="divide-y divide-gray-400 px-8">
        <li><button data-name="id_organismo-todos" data-target="id_organismo" class="filter filter-button active clicked block w-full text-left p-2">
            <span>Todos</span>
            <span class="background background-tres flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text-white">{{$data->total}}</span>
        </button></li>
        <li><button data-name="id_organismo-inaes" data-target="id_organismo" value="1" class="filter filter-button block w-full text-left p-2">
            <span>INAES</span> 
            <span class="background background-tres flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text-white">{{$data->inaes}}</span>
        </button></li>
        <li><button data-name="id_organismo-otros_organismos" data-target="id_organismo" value="2" class="filter filter-button block w-full text-left p-2">
            <span>Otros organismos</span> 
            <span class="background background-tres flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text-white">{{$data->otros_organismos}}</span>
        </button></li>
    </ul>
</div>