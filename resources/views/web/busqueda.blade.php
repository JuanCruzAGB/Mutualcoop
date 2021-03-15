<?php
    /** @var Obra|null $obras */
    /** @var Tipo[] $tipos_normativas */
    /** @var Tipo[] $tipos_gestiones */
    /** @var Organismo[] $organismos */
    /** @var Tema[] $temas */
    /** @var Categoria[] $categorias */
    /** @var Nomrativa[] $normativas */
    /** @var int $cantidad_normativas */
    /** @var Gestion[] $gestiones */
    /** @var int $cantidad_gestiones */
    /** @var string|false $busqueda */
?>

@extends('layout.index')

@section('css')
  <link href="{{ asset('css/web/busqueda.css') }}" rel="stylesheet">
@endsection

@section('titulo')
  Resultado de busqueda
@endsection

@section('main')
  <div class="container">
    <div class="buscadorLoco">
      <form id="normativas" action="busqueda">
        <div class="input-field col s12">
          <input placeholder="Buscar" id="search" name="buscar" class="autocomplete" type="search" required autocomplete="off" value="{{$busqueda}}"><span><i class="material-icons lupa">search</i></span>
        </div>
      </form>
    </div>
    @if($busqueda)
      <h1>Resultado de "{{ $busqueda }}"</h1>

      <div class="row col s12 m6 l6 xl6">
        @if($cantidad == 0)
          <div>
            <span>No hay resultados de su busqueda</span>
          </div>
        @else

        

          <div class="contenido">
            <div class="col filtro s12 m4 pull-m1 l7 xl6">
              <div class="collection expansor">
                <a class="collection-header"><h3>Filtros<span href="#!" class="secondary-content"><i class="material-icons">expand_more</i></span></h3></a>
              </div>
              <div class="collection elementos">
                <a class="collection-header"><h3>Buscar</h3></a>
                <a href="#!" class="collection-item active" data-id="0">Todo</a>
                <a href="#!" class="collection-item" data-id="1">Gestiones</a>
                <a href="#!" class="collection-item" data-id="2">Normativas</a>
              </div>
              <div class="collection obras">
                <a class="collection-header"><h3>Obras</h3></a>
                <a href="#!" class="collection-item active" data-id="0">Todas</a>
                @foreach($obras as $obra)
                  <a href="#!" class="collection-item" data-id="{{$obra->id_obra}}">{{$obra->nombre}}</a>
                @endforeach
              </div>
              <div class="collection tipos normativas">
                <a class="collection-header"><h3>Tipos de Normativas</h3></a>
                <a href="#!" class="collection-item active" data-id="0">Todas</a>
                @foreach($tipos_normativas as $tipo)
                  <a href="#!" class="collection-item" data-id="{{$tipo->id_tipo}}">{{$tipo->nombre}}</a>
                @endforeach
              </div>
              <div class="collection tipos gestiones">
                <a class="collection-header"><h3>Tipos de Gestión</h3></a>
                <a href="#!" class="collection-item active" data-id="0">Todos</a>
                @foreach($tipos_gestiones as $tipo)
                  <a href="#!" class="collection-item" data-id="{{$tipo->id_tipo}}">{{$tipo->nombre}}</a>
                @endforeach
              </div>
              <div class="collection organismos">
                <a class="collection-header"><h3>Organismos</h3></a>
                <a href="#!" class="collection-item active" data-id="0">Todos</a>
                @foreach($organismos as $organismo)
                  <a href="#!" class="collection-item" data-id="{{$organismo->id_organismo}}">{{$organismo->nombre}}</a>
                @endforeach
              </div>
              <div class="collection temas">
                <a class="collection-header"><h3>Temas</h3></a>
                <a href="#!" class="collection-item active" data-id="0">Todos</a>
                @foreach($temas as $tema)
                  <a href="#!" class="collection-item" data-id="{{$tema->id_tema}}" data-organismo="{{$tema->id_organismo}}">{{$tema->nombre}}</a>
                @endforeach
              </div>
              <div class="collection categorias">
                <a class="collection-header"><h3>Categorias</h3></a>
                <a href="#!" class="collection-item active" data-id="0">Todas</a>
                @foreach($categorias as $categoria)
                  <a href="#!" class="collection-item" data-id="{{$categoria->id_categoria}}" data-tipo="{{$categoria->id_tipo_gestion}}">{{$categoria->nombre}}</a>
                @endforeach
              </div>
            </div>
            <ul class="col s12 m6 l12 push-l7 xl12 push-xl8"></ul>
          </div>
        @endif
      </div>
    @else
      <div class="row col s12 m6 l6 xl6">
        <div>
          <span>No ha buscado nada aun</span>
        </div>
      </div>
    @endif
  </div>
  <div class="paginador">
      <ul class="pagination"></ul>
  </div>
@endsection

@section('footer')
  @component('components.footer')
  @endcomponent
@endsection

@section('js')
  <script>
  @if($busqueda)
    @if($cantidad == 0)
      var elementos_array = false;
    @else
      var elementos_array = @json($elementos);
    @endif
  @endif
  const obras_array = @json($obras);
  const id_usuario = {{Auth::id()}} ;

  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
  </script>
  <script type="text/javascript" src="{{ asset('js/route.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/buscador.js') }}"></script>
  @if($busqueda)
    <script type="text/javascript" src="{{ asset('js/web/busqueda.js') }}"></script>
  @endif
@endsection