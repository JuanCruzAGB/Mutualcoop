<div class="categorias">
    <h3 class="text-2xl text-center py-4">Filtrar por Categoría</h3>

    <ul class="divide-y divide-gray-400 px-8">
        @foreach($data as $categoria)
            @if($categoria->id_categoria == 0)
            <li><button data-name="id_categoria-todos" data-target="id_categoria" class="filter filter-button active clicked block w-full text-left p-2">
                <span>{{$categoria->camelName}}</span>
                <span class="background background-tres flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text-white">{{$categoria->value}}</span>
            </button></li>
            @else
            <li><button data-name="id_categoria-{{$categoria->nombre}}" data-target="id_categoria" class="filter filter-button block w-full text-left p-2" value="{{$categoria->id_categoria}}">
                <span>{{$categoria->camelName}}</span>
                <span class="background background-tres flex justify-center items-center floating-number text-center float-right rounded-full h-8 w-8 text-white">{{$categoria->value}}</span>
            </button></li>
            @endif
        @endforeach
    </ul>   
</div>