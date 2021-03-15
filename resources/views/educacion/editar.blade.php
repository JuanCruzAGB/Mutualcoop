@extends('layout.panel')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/poncho/icono-arg.css') }}">
    <link href={{ asset('css/tw.css') }} rel="stylesheet" />
    <link href={{ asset('css/auth/auth.css') }} rel="stylesheet" />
    <link href={{ asset('submodules/InputFileMakerJS/css/styles.css') }} rel="stylesheet">
    <link href={{ asset('css/educacion/editar.css') }} rel="stylesheet">
@endsection

@section('nav')
@component('components.nav.panel', ['current' => 'panel'])
@endcomponent
@endsection

@section('title')
    Editar "{{$educacion->titulo}}"
@endsection

@section('main')
    <header class="md:flex md:justify-center background background-dos w-full">
        <section class="form-container mx-auto w-10/12 md:w-6/12 lg:w-5/12 background background-dos px-6">
            <form id="educacion-editar" class="px-4 my-12 rounded-lg lg:px-4 rounded w-full bg-white none" action="/educacion/{{$educacion->id_educacion}}/editar" method="post" enctype="multipart/form-data"
                data-rules="{{json_encode($validation->rules)}}"
                data-messages="{{json_encode($validation->messages)}}">
                <header>
                    <h2 class="text-2xl text-center py-8">Editar "{{$educacion->titulo}}"</h2>
                </header>
                @csrf
                @method('PUT')
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="titulo"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Título *" title="Campo obligatorio" value="{{old('titulo', $educacion->titulo)}}">
                    @if($errors->has('titulo'))
                        <span class="support support-box support-titulo error pl-1 font-bold w-full">{{$errors->first('titulo')}}</span>
                    @else
                        <span class="support support-box support-titulo error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="mb-4 flex justify-center flex-wrap my-8 outline-none">
                    <textarea class="form-input ckeditor descripcion resize-none" id="copete" name="copete" placeholder="Copete"
                        cols="100" rows="10">{!!old('copete', $educacion->copete)!!}</textarea>
                    @if($errors->has('copete'))
                        <span class="support support-box support-copete error pl-1 font-bold w-full">{{$errors->first('copete')}}</span>
                    @else
                        <span class="support support-box support-copete error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    @if(Storage::mimeType($educacion->archivo) == 'image/jpeg' || Storage::mimeType($educacion->archivo) == 'image/png')
                        <input class="form-input make-a-file make-an-image w-75"
                            type="file"
                            name="archivo"
                            data-text="Archivo"
                            data-src='{{asset("/storage/$educacion->archivo")}}'
                            data-notfound="{{$educacion->archivo}}">
                    @else
                        <input class="form-input make-a-file w-75"
                            type="file"
                            name="archivo"
                            data-text="Archivo"
                            data-notfound="{{$educacion->archivo}}">
                    @endif
                    @if($errors->has('archivo'))
                        <span class="support support-box support-archivo error pl-1 font-bold w-full">{{$errors->first('archivo')}}</span>
                    @else
                        <span class="support support-box support-archivo error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="flex items-center justify-center lg:justify-center py-4">
                    <input class="form-submit educacion-editar btn btn-dos p-2 px-8 my-4" type="submit" value="Editar Educacion">
                </div>
            </form>
        </section>
    </header>
@endsection

@section('js')
    <script>
        const suscriptions = [];
        const validation = @json($validation);
    </script>
    <script src={{asset('submodules/InputFileMakerJS/js/InputFileMaker.js')}}></script>
    <script src={{ asset('/vendors/ckeditor/ckeditor.js') }}></script>
    <script type="module" src={{ asset('js/educacion/editar.js') }}></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection