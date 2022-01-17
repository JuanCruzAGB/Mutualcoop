<section id="filters" class="sidebar right closed push-body">
    <div class="sidebar-header">
        <a href="#filters" class="sidebar-button close-btn right">
            <i class="sidebar-icon fas fa-times"></i>
        </a>
        <div class="sidebar-title">
            <h2>Filtros</h2>
        </div>
    </div>

    <div class="sidebar-content pb-4">
        @if($filtros)
            @foreach($filtros as $filtro => $data)
                @component($filtro, ['data' => $data])
                @endcomponent
            @endforeach
        @else
            <div class="sin_filtros text-center pt-4 text-gray-600">
                <p>No hay por lo que filtrar</p>
            </div>
        @endif
    </div>
</section>
