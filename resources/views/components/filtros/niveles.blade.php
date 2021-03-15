<div class="nivel">
    <h3 class="text-2xl text-center py-4">Filtrar por Nivel de Usuario</h3>

    <ul class="divide-y divide-gray-400 px-8">                
        <li><button data-name="id_nivel-todos" data-target="id_nivel" class="filter filter-button active clicked block w-full text-left p-2">
            <span>Todos</span>
            <span class="flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text text-uno">{{$data->total}}</span>
        </button></li>           
        <li><button data-name="id_nivel-suscriptores" data-target="id_nivel" value="1" class="filter filter-button block w-full text-left p-2">
            <span>Suscriptor</span>
            <span class="flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text text-uno">{{$data->suscriptores}}</span>
        </button></li>
        <li><button data-name="id_nivel-administradores" data-target="id_nivel" value="2" class="filter filter-button block w-full text-left p-2">
            <span>Administrador</span> 
            <span class="flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text text-uno">{{$data->administradores}}</span>
        </button></li>
    </ul>   
</div>