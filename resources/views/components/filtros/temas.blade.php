<div class="temas">
    <h2 class="text-2xl text-center py-4">Filtrar por Tema</h2>

    <ul>
        @foreach($data as $tema)
        <li class="checkbox mx-auto w-8/12 md:w-7/12 lg:10/12 xl:w-8/12">
            <input data-name="temas-{{$tema->slug}}" class="filter filter-checkbox" data-target="temas" name="id_tema" value="{{$tema->id_tema}}" type="checkbox" id="{{$tema->slug}}">
            <label class="mt-2" for="{{$tema->slug}}">{{$tema->nombre}}</label>
        </li>
        @endforeach
    </ul>
</div>