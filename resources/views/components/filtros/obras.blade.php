<div class="obras">
    <h2 class="text-2xl text-center py-4">Filtrar por Tipo de Obra</h2>

    <ul>
        @foreach($data as $obra)
        <li class="checkbox mx-auto w-8/12 md:w-7/12 lg:10/12 xl:w-8/12">
            <input data-name="obras-{{$obra->slug}}" class="filter filter-checkbox" data-target="obras" name="id_obra" value="{{$obra->id_obra}}" type="checkbox" id="{{$obra->slug}}">
            <label class="mt-2" for="{{$obra->slug}}">{{$obra->nombre}}</label>
        </li>
        @endforeach
    </ul>
</div>