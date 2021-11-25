@extends('layout.panel')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/poncho/icono-arg.css') }}">
    <link href={{ asset('css/datepicker/datepicker.min.css') }} rel="stylesheet" />
    <link href={{ asset('css/tw.css') }} rel="stylesheet" />
    <link href={{ asset('css/auth/auth.css') }} rel="stylesheet" />
    <link href={{ asset('submodules/InputFileMakerJS/css/styles.css') }} rel="stylesheet">
    <link href={{ asset('css/normativa/crear.css') }} rel="stylesheet">
@endsection

@section('nav')
@component('components.nav.panel', ['current' => 'panel'])
@endcomponent
@endsection

@section('title')
    Crear Normativa
@endsection

@section('main')
    <header class="md:flex md:justify-center background background-dos w-full">
        <section class="form-container mx-auto w-10/12 md:w-6/12 lg:w-5/12 background background-dos px-6">
            <form id="normativa-crear" class="px-4 my-12 rounded-lg lg:px-4 rounded w-full bg-white none" action="/normativa/crear" method="post" enctype="multipart/form-data"
                data-rules="{{json_encode($validation->rules)}}"
                data-messages="{{json_encode($validation->messages)}}">
                <header>
                    <h2 class="text-2xl text-center py-8">Crear normativa</h2>
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
                    <textarea class="form-input ckeditor descripcion resize-none" id="copete" name="copete" placeholder="Copete *" title="Campo obligatorio"
                        cols="100" rows="10">{!!old('copete')!!}</textarea>
                    @if($errors->has('copete'))
                        <span class="support support-box support-copete error pl-1 font-bold w-full">{{$errors->first('copete')}}</span>
                    @else
                        <span class="support support-box support-copete error pl-1 font-bold w-full"></span>
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
                    <input class="form-input make-a-file make-an-image w-75"
                        type="file"
                        name="archivo"
                        data-text="Archivo"
                        data-notfound="No se eligió ninguna imagen o pdf. *" title="Campo obligatorio">
                    @if($errors->has('archivo'))
                        <span class="support support-box support-archivo error pl-1 font-bold w-full">{{$errors->first('archivo')}}</span>
                    @else
                        <span class="support support-box support-archivo error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="mb-4 flex justify-center flex-wrap mb-8 outline-none">
                    <select class="form-input p-3 outline-none bg-white" title="Campo obligatorio" name="id_tipo_normativa">
                        <option {{ !old("id_tipo_normativa") ? 'selected' : '' }} disabled>Tipo de Normativa *</option>
                        @foreach($tipos as $tipo)
                            <option {{ old('id_tipo_normativa') == $tipo->id_tipo ? 'selected' : '' }} value="{{$tipo->id_tipo}}">{{$tipo->nombre}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('id_tipo_normativa'))
                        <span class="support support-box support-id_tipo_normativa error pl-1 font-bold w-full">{{$errors->first('id_tipo_normativa')}}</span>
                    @else
                        <span class="support support-box support-id_tipo_normativa error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="mb-4 flex justify-center flex-wrap mb-8 outline-none">
                    <select class="form-input p-3 outline-none bg-white" title="Campo obligatorio" name="id_organismo">
                        <option {{ !old("id_organismo") ? 'selected' : '' }} disabled>Organismo *</option>
                        @foreach($organismos as $organismo)
                            <option {{ old('id_organismo') == $organismo->id_organismo ? 'selected' : '' }} value="{{$organismo->id_organismo}}">{{$organismo->nombre}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('id_organismo'))
                        <span class="support support-box support-id_organismo error pl-1 font-bold w-full">{{$errors->first('id_organismo')}}</span>
                    @else
                        <span class="support support-box support-id_organismo error pl-1 font-bold w-full"></span>
                    @endif
                </div>

                <div class="checkbox-obras w-8/12 mx-auto xl:w-6/12">
                    <ul class="obras my-8">
                        @foreach($obras as $obra)
                            <li class="checkbox mx-auto w-8/12 md:w-7/12 lg:w-10/12">
                                @if(is_array(old('obras')) && in_array($obra->id_obra, old('obras')))
                                    <input value="{{$obra->id_obra}}" name="obras[{{$obra->slug}}]" checked id="{{$obra->slug}}" class="form-input obra" type="checkbox">
                                @else
                                    <input value="{{$obra->id_obra}}" name="obras[{{$obra->slug}}]" id="{{$obra->slug}}" class="form-input obra" type="checkbox">
                                @endif
                                <label class="mt-2" for="{{$obra->slug}}">{{$obra->nombre}}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mb-4 flex justify-center flex-wrap mb-8 outline-none">
                    <select multiple class="form-input p-3 h-16 outline-none bg-white" title="Campo obligatorio" name="temas[]">
                        <option {{ old("temas") ? 'selected' : '' }} disabled>Tema *: Seleccione algún Organismo y una Obra primero</option>
                    </select>
                    @if($errors->has('temas'))
                        <span class="support support-box support-temas error pl-1 font-bold w-full">{{$errors->first('temas')}}</span>
                    @else
                        <span class="support support-box support-temas error pl-1 font-bold w-full"></span>
                    @endif
                </div>                
                    @if($errors->has('obras'))
                        <span class="support support-box support-obras error pl-1 font-bold w-full">{{$errors->first('obras')}}</span>
                    @else
                        <span class="support support-box support-obras error pl-1 font-bold w-full"></span>
                    @endif
                <div class="flex items-center justify-center lg:justify-center py-4">
                    <input class="form-submit normativa-crear btn btn-dos p-2 px-8 my-4" type="submit" value="Crear Normativa">
                </div>
            </form>
        </section>
    </header>
@endsection

@section('js')
    <script>
        const suscriptions = [];
        const temas = @json($temas);
        const oldTemas = @json(old('temas'));
        const oldObras = @json(old('obras'));
        const validation = @json($validation);
        @if(old('fecha'))
            const fecha = @json(old('fecha'));
        @else
            const fecha = '';
        @endif
    </script>
    <script src={{asset('submodules/InputFileMakerJS/js/InputFileMaker.js')}}></script>
    <script type="module" src={{ asset('js/datepicker/datepicker.min.js') }}></script>
    <script type="module" src={{ asset('js/datepicker/idioma/datepicker.es.js') }}></script>
    <script src={{ asset('/vendors/ckeditor/ckeditor.js') }}></script>
    <script type="module" src={{ asset('js/normativa/crear.js') }}></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection