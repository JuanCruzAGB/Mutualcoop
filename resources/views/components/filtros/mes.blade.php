<div class="mes">
    <h3 class="text-2xl text-center py-4">Filtrar por mes</h3>

    <div class="flex justify-around">
        <div class="arrow">
            <button value="{{'(-' . date('m', strtotime('-1 month', strtotime(date('Y-m-d')))) . '-)'}}" class="fecha fecha-left p-2 btn btn-dos left no-text arrow prev">
                <i class="fas fa-arrow-left"></i>
            </button>
        </div>

        <select data-name="fecha-select" data-target="{{$data}}" class="filter filter-select filter-regexp outline-none text-xl p-2">
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