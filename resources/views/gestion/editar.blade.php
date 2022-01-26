@extends('layout.panel')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/poncho/icono-arg.css') }}">
    <link href={{ asset('css/datepicker/datepicker.min.css') }} rel="stylesheet" />
    <link href={{ asset('css/tw.css') }} rel="stylesheet" />
    <link href={{ asset('css/auth/auth.css') }} rel="stylesheet" />
    <link href={{ asset('submodules/InputFileMakerJS/css/styles.css') }} rel="stylesheet">
    <link href={{ asset('css/gestion/editar.css') }} rel="stylesheet">
@endsection

@section('nav')
@component('components.nav.panel', ['current' => 'panel'])
@endcomponent
@endsection

@section('title')
    Editar "{{$gestion->titulo}}"
@endsection

@section('main')
    <header class="md:flex md:justify-center background background-dos w-full">
        <section class="form-container mx-auto w-10/12 md:w-6/12 lg:w-5/12 background background-dos px-6">
            <form id="gestion-editar" class="px-4 my-12 rounded-lg lg:px-4 rounded w-full bg-white none" action="/gestion/{{$gestion->id_gestion}}/editar" method="post" enctype="multipart/form-data"
                data-rules="{{json_encode($validation->rules)}}"
                data-messages="{{json_encode($validation->messages)}}">
                <header>
                    <h2 class="text-2xl text-center py-8">Editar "{{$gestion->titulo}}"</h2>
                </header>
                @csrf
                @method('PUT')
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="titulo"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Título *" title="Campo obligatorio" value="{{old('titulo', $gestion->titulo)}}">
                    @if($errors->has('titulo'))
                        <span class="support support-box support-titulo error pl-1 font-bold w-full">{{$errors->first('titulo')}}</span>
                    @else
                        <span class="support support-box support-titulo error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="mb-4 flex justify-center flex-wrap my-8 outline-none">
                    <textarea class="form-input ckeditor descripcion resize-none" id="copete" name="copete" placeholder="Copete"
                        cols="100" rows="10">{!!old('copete', $gestion->copete)!!}</textarea>
                    @if($errors->has('copete'))
                        <span class="support support-box support-copete error pl-1 font-bold w-full">{{$errors->first('copete')}}</span>
                    @else
                        <span class="support support-box support-copete error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    @if(Storage::mimeType($gestion->archivo) == 'image/jpeg' || Storage::mimeType($gestion->archivo) == 'image/png')
                        <input class="form-input make-a-file make-an-image w-75"
                            type="file"
                            name="archivo"
                            data-text="Archivo"
                            data-src='{{asset("/storage/$gestion->archivo")}}'
                            data-notfound="{{$gestion->archivo}}">
                    @else
                        <input class="form-input make-a-file w-75"
                            type="file"
                            name="archivo"
                            data-text="Archivo"
                            data-notfound="{{$gestion->archivo}}">
                    @endif
                    @if($errors->has('archivo'))
                        <span class="support support-box support-archivo error pl-1 font-bold w-full">{{$errors->first('archivo')}}</span>
                    @else
                        <span class="support support-box support-archivo error pl-1 font-bold w-full"></span>
                    @endif
                </div>

                <div class="checkbox-obras w-8/12 mx-auto xl:w-6/12">
                    <ul class="obras my-8">
                        @foreach($obras as $obra)
                            <li class="checkbox mx-auto w-8/12 md:w-7/12 lg:w-10/12">
                                @if(is_array(old('obras', $gestion->obras)) && in_array($obra->id_obra, old('obras', $gestion->obras)))
                                    <input class="form-input obra" value="{{$obra->id_obra}}" name="obras[{{$obra->slug}}]" checked id="{{$obra->slug}}" type="checkbox">
                                @else
                                    <input class="form-input obra" value="{{$obra->id_obra}}" name="obras[{{$obra->slug}}]" id="{{$obra->slug}}" type="checkbox">
                                @endif
                                <label class="mt-2" for="{{$obra->slug}}">{{$obra->nombre}}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                    @if($errors->has('obras'))
                        <span class="support support-box support-obras error pl-1 font-bold w-full">{{$errors->first('obras')}}</span>
                    @else
                        <span class="support support-box support-obras error pl-1 font-bold w-full"></span>
                    @endif

                <div class="mb-4 flex justify-center flex-wrap mb-8 outline-none">
                    <select class="form-input p-3 outline-none bg-white" name="id_tipo_gestion" title="Campo obligatorio">
                        <option {{ !old("id_tipo_gestion", $gestion->id_tipo_gestion) ? 'selected' : '' }} disabled>Tipo de Gestión *: Seleccione alguna Obra primero</option>
                    </select>
                    @if($errors->has('id_tipo_gestion'))
                        <span class="support support-box support-id_tipo_gestion error pl-1 font-bold w-full">{{$errors->first('id_tipo_gestion')}}</span>
                    @else
                        <span class="support support-box support-id_tipo_gestion error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="mb-4 flex justify-center flex-wrap mb-8 outline-none">
                    <select class="form-input p-3 outline-none bg-white" name="id_categoria">
                        <option {{ !old("id_categoria", $gestion->id_categoria) ? 'selected' : '' }} disabled>Categoría: Seleccione alguna Gestión y una Obra primero</option>
                    </select>
                    @if($errors->has('id_categoria'))
                        <span class="support support-box support-id_categoria error pl-1 font-bold w-full">{{$errors->first('id_categoria')}}</span>
                    @else
                        <span class="support support-box support-id_categoria error pl-1 font-bold w-full"></span>
                    @endif
                </div>
               
                <div class="flex items-center justify-center lg:justify-center py-4">
                    <input class="form-submit gestion-editar btn btn-dos p-2 px-8 my-4" type="submit" value="Editar Gestion">
                </div>
            </form>
        </section>
    </header>
@endsection

@section('js')
    <script>
        const suscriptions = [];
        const tipos = @json($tipos);
        const oldTipo = @json(old('id_tipo_gestion', $gestion->id_tipo_gestion));
        const categorias = @json($categorias);
        const oldCategoria = @json(old('id_categoria', $gestion->id_categoria));
        const oldObras = @json(old('obras', $gestion->obras));
        const validation = @json($validation);
    </script>
    <script src={{asset('submodules/InputFileMakerJS/js/InputFileMaker.js')}}></script>
    <script src={{ asset('/vendors/ckeditor/ckeditor.js') }}></script>
    <script type="module" src={{ asset('js/gestion/editar.js') }}></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection