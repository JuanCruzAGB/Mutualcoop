@extends('layout.panel')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/poncho/icono-arg.css') }}">
    <link href={{ asset('css/datepicker/datepicker.min.css') }} rel="stylesheet" />
    <link href={{ asset('css/tw.css') }} rel="stylesheet" />
    <link href={{ asset('css/auth/auth.css') }} rel="stylesheet" />
    <link href={{ asset('submodules/InputFileMakerJS/css/styles.css') }} rel="stylesheet">
    <link href={{ asset('css/evento/crear.css') }} rel="stylesheet">
@endsection

@section('nav')
@component('components.nav.panel', ['current' => 'panel'])
@endcomponent
@endsection

@section('title')
    Crear Evento
@endsection

@section('main')
    <header class="md:flex md:justify-center background background-dos w-full">
        <section class="form-container mx-auto w-10/12 md:w-6/12 lg:w-5/12 background background-dos px-6">
            <form id="evento-crear" class="px-4 my-12 rounded-lg lg:px-4 rounded w-full bg-white none" action="/evento/crear" method="post" enctype="multipart/form-data"
                data-rules="{{json_encode($validation->rules)}}"
                data-messages="{{json_encode($validation->messages)}}">
                <header>
                    <h2 class="text-2xl text-center py-8">Crear Evento</h2>
                </header>
                @csrf
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="titulo"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Título *" title="Campo obligatorio" value="{{old('titulo')}}">
                    @if($errors->has('titulo'))
                        <span class="support support-box support-titulo error pl-1 font-bold w-full">{{$errors->first('titulo')}}</span>
                    @else
                        <span class="support support-box support-titulo error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="mb-4 flex justify-center flex-wrap my-8 outline-none">
                    <textarea class="form-input ckeditor descripcion resize-none" id="descripcion" name="descripcion" placeholder="Descripción"
                        cols="100" rows="10">{!!old('descripcion')!!}</textarea>
                    @if($errors->has('descripcion'))
                        <span class="support support-box support-descripcion error pl-1 font-bold w-full">{{$errors->first('descripcion')}}</span>
                    @else
                        <span class="support support-box support-descripcion error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input class="form-input make-a-file make-an-image w-75"
                        type="file"
                        name="archivo"
                        data-text="Archivo"
                        data-notfound="No se eligió ningún archivo. *" title="Campo obligatorio">
                    @if($errors->has('archivo'))
                        <span class="support support-box support-archivo error pl-1 font-bold w-full">{{$errors->first('archivo')}}</span>
                    @else
                        <span class="support support-box support-archivo error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input id="calendario" type='text' name="fecha" class='form-input datepicker-here w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline' 
                        data-language='es' data-position="bottom center" placeholder="Fecha *" title="Campo obligatorio" value="{{old('fecha')}}"/>
                    <label class="calendario" for="calendario">
                        <i class="icono-arg-calendario-2"></i>
                    </label>
                    @if($errors->has('fecha'))
                        <span class="support support-box support-fecha error pl-1 font-bold w-full">{{$errors->first('fecha')}}</span>
                    @else
                        <span class="support support-box support-fecha error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="organizador"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Organizador" value="{{old('organizador')}}">
                    @if($errors->has('organizador'))
                        <span class="support support-box support-organizador error pl-1 font-bold w-full">{{$errors->first('organizador')}}</span>
                    @else
                        <span class="support support-box support-organizador error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="video"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="url" placeholder="Url del video" value="{{old('video')}}">
                    @if($errors->has('video'))
                        <span class="support support-box support-video error pl-1 font-bold w-full">{{$errors->first('video')}}</span>
                    @else
                        <span class="support support-box support-video error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="url_inscripcion"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="url" placeholder="Url de la inscripción" value="{{old('url_inscripcion')}}">
                    @if($errors->has('url_inscripcion'))
                        <span class="support support-box support-url_inscripcion error pl-1 font-bold w-full">{{$errors->first('url_inscripcion')}}</span>
                    @else
                        <span class="support support-box support-url_inscripcion error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="checkbox-obras w-8/12 mx-auto xl:w-6/12">
                    <ul class="obras my-8">
                        <li class="checkbox mx-auto w-8/12 md:w-7/12 lg:w-10/12">
                            <input name="privado" value="1" name="privado" {{ (old('privado') && old('privado') == 1) ? 'checked' : '' }} class="form-input filter filter-checkbox" id="privado" type="checkbox">
                            <label class="mt-2" for="privado">Privado</label>
                        </li>
                    </ul>
                    @if($errors->has('privado'))
                        <span class="support support-box support-privado error pl-1 font-bold w-full">{{$errors->first('privado')}}</span>
                    @else
                        <span class="support support-box support-privado error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="flex items-center justify-center lg:justify-center py-4">
                    <input class="form-submit evento-crear btn btn-dos p-2 px-8 my-4" type="submit" value="Crear Evento">
                </div>
            </form>
        </section>
    </header>
@endsection

@section('js')
    <script>
        const suscriptions = [];
        @if(old('fecha'))
        const fecha = @json(old('fecha'));
        @else
        const fecha = '';
        @endif
        const validation = @json($validation);
    </script>
    <script src={{asset('submodules/InputFileMakerJS/js/InputFileMaker.js')}}></script>
    <script type="module" src={{ asset('js/datepicker/datepicker.min.js') }}></script>
    <script type="module" src={{ asset('js/datepicker/idioma/datepicker.es.js') }}></script>
    <script src={{ asset('/vendors/ckeditor/ckeditor.js') }}></script>
    <script type="module" src={{ asset('js/evento/crear.js') }}></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection