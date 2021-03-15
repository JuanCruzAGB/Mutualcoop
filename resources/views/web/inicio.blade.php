<?php
    /** @var Noticia[] $noticias */
    /** @var int $cantidad_noticias */
    /** @var Evento[] $eventos */
    /** @var int $cantidad_eventos */
    /** @var Obra[] $obras */
?>

@extends('layout.index')

@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/> 
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.css') }}"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/web/inicio.css') }}" rel="stylesheet">
    <link href="{{ asset('css/WhatsApp.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tooltip.css') }}" rel="stylesheet">
@endsection

@section('titulo')
    Inicio
@endsection

@section('nav')
    @if(!Auth::check())
        <div class="row formRow">
            <section class="nav-form autofillLogin col s12 l6 push-l6 xl4 push-xl8">
                <form action="/ingresar" method="post" class="ingresar">
                    @csrf
                    <div class="input-field col s12 m6 l6 pull-l8">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="icon_prefix" type="text" name="dato" class="validate" value="{{ old('dato') }}">
                        <label for="icon_prefix">Correo/Suscripción</label>
                        @if($errors->has('dato'))
                        <span class="error">{{ $errors->first('dato') }}</span>
                        @endif
                    </div>

                    <div class="input-field col s12 m6 l6 pull-l8">
                        <i class="material-icons prefix">lock</i>
                        <input id="icon_lock" type="password" name="clave" class="validate">
                        <label for="icon_lock">Contraseña</label>
                        @if($errors->has('clave'))
                        <span class="error">{{ $errors->first('clave') }}</span>
                        @endif
                    </div>

                    <div class="recordarDiv input-field col s1 pull-s3 m6 push-m1 l6 push-l9">
                        <label id="recordar">
                        <input class="recordar" name="recordar[]" value="false" type="checkbox"/>
                        <span>Recordarme</span>
                        </label>
                    </div>

                    <div class="ingresarDiv col s8 push-s6 m8 push-m4 l6 pull-l2" >
                        <button id="ingresarBtn" class="btn-small waves-effect waves-light grey lighten-5" type="submit" name="action">Ingresar
                        <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </section>
        </div>
    @endif
@endsection

@section('main')
    <div class="slider">
        <ul class="slides">
            <li>
                <img class="responsive-img" src="img/banners/1.jpg"> <!-- random image -->
                <div class="caption center-align">
                <h3>Asesoramos Cooperativas y Mutuales de todo el país</h3>
                </div>
            </li>
            <li>
                <img class="responsive-img" src="img/banners/2.jpg"> <!-- random image -->
                <div class="caption center-align">
                <h3>Capacitamos y formamos empresas</h3>
                </div>
            </li>
            <li>
                <img class="responsive-img" src="img/banners/3.jpg"> 
                <div class="caption right-align">
                <h3>Trabajamos a la par</h3>
                </div>
            </li>
        </ul>
    </div>

    <div class="row">
        <section id="obras" class="col s12 m12">
            <h2>Obras interactivas</h2>
            @foreach($obras as $obra)
                <div class="obras col s12 m5 push-m1 l5 push-l1 xl5 push-xl1">
                    <figure>
                        <img src="/img/{{ $obra->imagen }}" alt="foto de obra obra">
                    </figure>

                    <h2>{{ $obra->nombre }}</h2>

                    <p>{{ $obra->descripcion }}</p>

                    <a href="/obra/{{$obra->slug}}">Ver más</a>
                </div>
            @endforeach
        </section>
    </div>

    <!-- Modal Structure -->
    <div class="modalSuscripción">
        <div id="modal1" class="modal">
            <script type="text/javascript" src="https://v3.esmsv.com/form/renderwidget/format/widget/AdministratorID/85343/FormID/2"></script>
            <div class="modal-footer newsClose">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat"><i class="large material-icons">close</i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <section id="noticias" class="noticias col s12 m12 l12 xl12">
            <h2>Noticias</h2>
            <div>
                @if($cantidad_noticias <= 0)
                    <div>
                        <span>No hay noticias recientes.</span>
                    </div>
                @else
                    <ul class="col s12 m12 l12 xl12">
                        @foreach($noticias as $noticia)
                            <li class="noticia col s12 m12 l6 xl5 push-xl1 lis">
                                <div class="test">
                                    <h3>{{ $noticia->titulo }}</h3>

                                    @if($noticia->subtitulo)
                                        <h4 class="subtitulo">{{ $noticia->subtitulo }}</h4>
                                    @else
                                        <h4 class="sinSubtitulo">No tiene subtitulo</h4>
                                    @endif

                                    <figure>
                                        <img class="materialboxed imgNoticia" src="{{ asset('storage/' . $noticia->imagen) }}" alt="foto de una noticia">
                                    </figure>

                                    <div class="datosNoticia">
                                        <p>{!! nl2br($noticia->descripcion) !!}</p>

                                        <span>Fuente: {{ $noticia->fuente }}</span>

                                        <a href="/noticia/{{ $noticia->slug }}">Ver más</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    {{ $noticias->fragment('noticias')->links() }}
                @endif
            </div>
        </section>
    </div>
    
    <div class="row">
        <section id="eventos" class="eventos col s12">
            <h2>Agenda</h2>
            <div>
                @if($cantidad_eventos <= 0)
                    <div class="col s12">
                        <span>No hay eventos recientes</span>
                    </div>
                @else
                    <ul class="s12 m12 l12 xl12">
                        @foreach($eventos as $evento)
                            <li id="agendaDatos" class="evento col s12 m12 l6 xl6">
                                <div class="divFecha">
                                    <span class="fecha">{{ $evento->dia }}</span>
                                    <span class="fecha">{{ $evento->mes }}</span>
                                </div>

                                <div>
                                    <h2>{{ $evento->titulo }}</h2>
                                        
                                    <span class="organizador">Organiza: {{ $evento->organizador }}</span>

                                    <div class="links">
                                        <a target="_blank" href="/storage/{{ $evento->pdf }}">Ver más</a>
                                        <a target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLScGPe1BV5gRg71LxM0LOggwZY7iHKVRPb5DYRoW5QK6WFrKLQ/viewform">Inscribirme</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </section>
    </div>

    <div class="row">
        <section class="col s12" id="contacto">
            <h2>Contacto</h2>
                <form class="contacto" action="/contactar" method="post">
                    @csrf
                    <div class="col s12 m8 pull-m2 l6 pull-l3 xl4 pull-xl4">
                        <div class="input-field col s12">
                            <i class="material-icons prefix icono">account_circle</i>
                            <input autocomplete='off' id="account_circle" type="text" name="nombre" class="validate nombrecito" value="{{ old('nombre') }}">
                            <label for="account_circle">Nombre <b data-tooltip="Dato Obligatorio">(*)</b><span id="texto"></label>
                            <span class="error">@if($errors->has('nombre')){{ $errors->first('nombre') }}@endif</span>
                        </div>
                        
                        <div class="input-field col s12 divCorreo">
                            <i class="material-icons prefix icono">email</i>
                            <input autocomplete='off' id="icon_email" type="email" name="correo" class="validate emailcito" value="{{ old('correo') }}">
                            <label for="icon_email">Correo <b data-tooltip="Dato Obligatorio">(*)</b></label>
                            <span class="error">@if($errors->has('correo')){{ $errors->first('correo') }}@endif</span>
                        </div>
                        
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input autocomplete='off' id="icon_telephone" type="tel" name="telefono" class="telefonito validate" value="{{ old('telefono') }}">
                            <label for="icon_telephone">Teléfono <b data-tooltip="Dato Obligatorio">(*)</b></label>
                            <span class="error">@if($errors->has('telefono')){{ $errors->first('telefono') }}@endif</span>
                        </div>

                        <div class="input-field col s12">
                            <i class="material-icons prefix icono">description</i>
                            <textarea name="descripcion" id="description" class="validate descripcioncita materialize-textarea" data-length="120">{{ old('descripcion') }}</textarea>
                            <label for="description">Descripción <b data-tooltip="Dato Obligatorio">(*)</b></label>
                            <span class="error">@if($errors->has('descripcion')){{ $errors->first('descripcion') }}@endif</span>
                        </div>
                        
                        <div class="input-field col s12">
                            {!! Recaptcha::render() !!}
                            <span class="error">@if($errors->has('g-recaptcha-response')){{ $errors->first('g-recaptcha-response') }}@endif</span>
                        </div>
                
                        <div class="col s12 divSubmit">
                            <button class="btn-small waves-effect waves-light grey lighten-5" type="submit" name="action">
                                Enviar consulta
                                <i class="material-icons">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
    
    <div class="whatsapp">
        <a target="_blank" href="https://wa.me/5491167172626"><img src="/img/WhatsApp.png" alt="Icono de whatsapp"></a>
    </div>
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/tooltip.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/web/validarContacto.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.modal').modal();
        });

        const newsletter = document.querySelector('.modalSuscripción');

        function miModal(){
            setTimeout(() => { 
                $(document).ready(function(){
                $('.modal').modal();
                $('.modal').modal('open'); 
                }); 
            }, 10000);
            return false;
        }

        miModal();
    </script>
    @component('components.footer.global')
    @endcomponent
@endsection