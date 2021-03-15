<?php
    /** @var Obra $obra */
?>

@extends('layout.index')

@section('css')
  <link href="{{ asset('css/obra/detalles.css') }}" rel="stylesheet">
@endsection

@section('titulo')
  {{$obra->nombre}}
@endsection

@section('main')
<div class="row">
  <section class="detallesObras col s12">								
    <h2>{{$obra->nombre}}</h2>
    @if($obra->id_obra != 4)
      <p>Nuestras obras siempre cuentan con <strong>toda la información disponible</strong> constituyendo algo así como un manual de instrucciones de cada tipo de entidad. Reuniendo en un solo producto en forma ordenada toda la información, en versión on line mediante nuestro portal web, y en forma impresa por medio de material actualizable.</p>
      <p>La novedad que introducimos para su comodidad radica justamente en achicar el volumen de estos, para que sirvan solo como indicador y como un nexo que lo vincule en forma ágil y  precisa a toda la información completa que se encuentra en la página.</p>
    @else
      <p>Esta obra está destinada para todos aquellos interesados en profundizar sus conocimientos sobre la temática de Prevención de Lavado de Activos y Financiación del Terrorismo, por ser Sujetos Obligados ante la Unidad de Información Financiera, ya sean Cooperativas y Mutuales que otorgan créditos, como asimismo Profesionales y todo tipo de Empresas que se encuentren alcanzados por la normativa vigente.</p>
    @endif

    <figure>
      <img class="imgObra" src="/img/{{ $obra->imagen }}" alt="foto de obra obra">
    </figure>
    <p>{{ $obra->descripcion }}</p>

    @if($obra->id_obra == 1 || $obra->id_obra == 2)

      <h3>Normativa actualizada</h3>

      <ul class="collection">
        <li class="collection-item">Ley de Cooperativas</li>
        <li class="collection-item">Leyes y Decretos</li>
        <li class="collection-item">Resoluciones INAES</li>
        <li class="collection-item">Resoluciones</li>
        <li class="collection-item">Resoluciones Técnicas</li>
      </ul>
      
      <h3>Gestión</h3>
      <ul class="collection">
        <li class="collection-item">Normativa Vigente</li>
        <li class="collection-item">Normativa Servicios de Salud</li>
        <li class="collection-item">Códigos y Tablas Vigentes</li>
        <li class="collection-item">Cuadros Explicativos de Normativas</li>
        <li class="collection-item">Modelos de Cooperativas</li>
        <li class="collection-item">Información de Interés Laboral</li>
        <li class="collection-item">Educación y Capacitación</li>
        <li class="collection-item">Educación y Capacitación</li>
        <li class="collection-item">Agenda Impositiva y Laboral</li>
        <li class="collection-item">Jurisprudencia</li>
      </ul>

    @elseif($obra->id_obra == 3)
      <h3>Normativa actualizada</h3>

      <ul class="collection">
        <li class="collection-item">Ley de Mutuales</li>
        <li class="collection-item">Leyes y Decretos</li>
        <li class="collection-item">Resoluciones INAES</li>
        <li class="collection-item">Resoluciones</li>
        <li class="collection-item">Resoluciones Técnicas</li>
      </ul>

      <ul class="collection">
        <li class="collection-item">Ley de Mutuales</li>
        <li class="collection-item">Leyes y Decretos</li>
        <li class="collection-item">Resoluciones INAES</li>
        <li class="collection-item">Resoluciones</li>
        <li class="collection-item">Resoluciones Técnicas</li>
      </ul>

      <h3>Gestión</h3>
      <ul>
        <li class="collection-item">Normativa Vigente</li>
        <li class="collection-item">Normativa Servicios de Salud</li>
        <li class="collection-item">Códigos y Tablas Vigentes</li>
        <li class="collection-item">Cuadros Explicativos de Normativas</li>
        <li class="collection-item">Modelos de Mutuales</li>
        <li class="collection-item">Reglamento de los Servicios</li>
        <li class="collection-item">Información de Interés Laboral</li>
        <li class="collection-item">Educación y Capacitación</li>
        <li class="collection-item">Agenda Impositiva y Laboral</li>
        <li class="collection-item">Jurisprudencia</li>
      </ul>
    @else

      <h3>¿Qué ofrecemos?</h3>
      
        <p>Una Obra impresa actualizada en forma mensual.
        Acceso al Sitio Web de Mutualcoop donde encontrará la Obra en formato digital.
        Foro de intercambio exclusivo para suscriptores de la Obra UIF-Créditos, donde podrán volcar consultas y enriquecerlas con el aporte de otras entidades como así también recibirán por este medio las actualizaciones que los mantendrán al tanto de las noticias más sobresalientes del área crediticia.
        Servicio de asesoramiento permanente vía e-mail.
        Se realizarán encuentros presenciales <strong>gratuitos</strong> acerca de la temática UIF-Créditos, destinado a ofrecerles las actualizaciones del área y donde podrán volcar consultas.</p>
      
      <h3>Normativa actualizada</h3>
      <ul class="collection">
        <li class="collection-item">Leyes y Decretos</li>
        <li class="collection-item">Información de Interés Laboral</li>
        <li class="collection-item">Resoluciones INAES</li>
        <li class="collection-item">Resoluciones</li>
        <li class="collection-item">Resoluciones Técnicas</li>
      </ul>

      <h3>GESTIÓN</h3>
      <ul class="collection">
        <li class="collection-item">Normativa Vigente (Leyes, Decretos y Resoluciones)</li>
        <li class="collection-item">UIF Introducción</li>
        <li class="collection-item">Análisis de la Reglamentación</li>
        <li class="collection-item">Auditoría</li>
        <li class="collection-item">Información Complementaria</li>
        <li class="collection-item">Jurisprudencia y Análisis</li>
        <li class="collection-item">Modelos Sugeridos</li>
      </ul>
    @endif

  <div class="divBtnSuscribite">
    <a class="btn" href="/#contacto">Suscribite aquí</a>
  </div>

  </section>
</div>
@endsection

@section('footer')
  @component('components.footer')
  @endcomponent
@endsection