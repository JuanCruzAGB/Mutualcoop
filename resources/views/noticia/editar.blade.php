@extends('layout.panel')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/poncho/icono-arg.css') }}">
    <link href={{ asset('css/datepicker/datepicker.min.css') }} rel="stylesheet" />
    <link href={{ asset('css/tw.css') }} rel="stylesheet" />
    <link href={{ asset('css/auth/auth.css') }} rel="stylesheet" />
    <link href={{ asset('submodules/InputFileMakerJS/css/styles.css') }} rel="stylesheet">
    <link href={{ asset('css/noticia/editar.css') }} rel="stylesheet">
@endsection

@section('nav')
@component('components.nav.panel', ['current' => 'panel'])
@endcomponent
@endsection

@section('title')
    Editar "{{$noticia->titulo}}"
@endsection

@section('main')
    <header class="md:flex md:justify-center background background-dos w-full">
        <section class="form-container mx-auto w-10/12 md:w-6/12 lg:w-5/12 background background-dos px-6">
            <form id="noticia-editar" class="px-4 my-12 rounded-lg lg:px-4 rounded w-full bg-white none" action="/noticia/{{$noticia->id_noticia}}/editar" method="post" enctype="multipart/form-data"
                data-rules="{{json_encode($validation->rules)}}"
                data-messages="{{json_encode($validation->messages)}}">
                <header>
                    <h2 class="text-2xl text-center py-8">Editar "{{$noticia->titulo}}"</h2>
                </header>
                @csrf
                @method('PUT')
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="titulo"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Título *" title="Campo obligatorio" value="{{old('titulo', $noticia->titulo)}}">
                    @if($errors->has('titulo'))
                        <span class="support support-box support-titulo error pl-1 font-bold w-full">{{$errors->first('titulo')}}</span>
                    @else
                        <span class="support support-box support-titulo error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="subtitulo"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Subtitulo" value="{{old('subtitulo', $noticia->subtitulo)}}">
                    @if($errors->has('subtitulo'))
                        <span class="support support-box support-subtitulo error pl-1 font-bold w-full">{{$errors->first('subtitulo')}}</span>
                    @else
                        <span class="support support-box support-subtitulo error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="mb-4 flex justify-center flex-wrap my-8 outline-none">
                    <textarea class="form-input ckeditor descripcion resize-none" id="descripcion" name="descripcion" placeholder="Descripción *" title="Campo obligatorio"
                        cols="100" rows="10">{!!old('descripcion', $noticia->descripcion)!!}</textarea>
                    @if($errors->has('descripcion'))
                        <span class="support support-box support-descripcion error pl-1 font-bold w-full">{{$errors->first('descripcion')}}</span>
                    @else
                        <span class="support support-box support-descripcion error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input class="form-input make-a-file make-an-image w-full"
                        type="file"
                        name="archivo"
                        data-text="Archivo"
                        data-src='{{asset("/storage/$noticia->archivo")}}'
                        data-notfound="{{$noticia->archivo}}">
                    @if($errors->has('archivo'))
                        <span class="support support-box support-archivo error pl-1 font-bold w-full">{{$errors->first('archivo')}}</span>
                    @else
                        <span class="support support-box support-archivo error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="fuente"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="url" placeholder="Fuente" value="{{old('fuente', $noticia->fuente)}}">
                    @if($errors->has('fuente'))
                        <span class="support support-box support-fuente error pl-1 font-bold w-full">{{$errors->first('fuente')}}</span>
                    @else
                        <span class="support support-box support-fuente error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="flex items-center justify-center lg:justify-center py-4">
                    <input class="form-submit noticia-editar btn btn-dos p-2 px-8 my-4" type="submit" value="Editar Noticia">
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
    <script type="module" src={{ asset('js/noticia/editar.js') }}></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection