@extends('layout.panel')

@section('css')
    <link href={{ asset('css/poncho/icono-arg.css') }} rel="stylesheet">
    <link href={{ asset('css/datepicker/datepicker.min.css') }} rel="stylesheet"/>
    <link href={{ asset('css/tw.css') }} rel="stylesheet"/>
    <link href={{ asset('css/auth/auth.css') }} rel="stylesheet"/>
    <link href={{ asset('submodules/InputFileMakerJS/css/styles.css') }} rel="stylesheet">
    <link href={{ asset('css/pregunta/editar.css') }} rel="stylesheet">
@endsection

@section('nav')
@component('components.nav.panel', ['current' => 'panel'])
@endcomponent
@endsection

@section('title')
    Editar "{{$pregunta->pregunta}}"
@endsection

@section('main')
    <header class="md:flex md:justify-center background background-dos w-full">
        <section class="form-container mx-auto w-10/12 md:w-6/12 lg:w-5/12 background background-dos px-6">
            <form id="pregunta-editar" class="px-4 my-12 rounded-lg lg:px-4 rounded w-full bg-white none" action="/pregunta/{{$pregunta->id_pregunta}}/editar" method="post" enctype="multipart/form-data"
                data-rules="{{json_encode($validation->rules)}}"
                data-messages="{{json_encode($validation->messages)}}">
                <header>
                    <h2 class="text-2xl text-center py-8">Editar "{{$pregunta->pregunta}}"</h2>
                </header>
                @csrf
                @method('PUT')
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="pregunta"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Pregunta *" title="Campo obligatorio" value="{{old('pregunta', $pregunta->pregunta)}}">
                    @if($errors->has('pregunta'))
                        <span class="support support-box support-pregunta error pl-1 font-bold w-full">{{$errors->first('pregunta')}}</span>
                    @else
                        <span class="support support-box support-pregunta error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="respuesta"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Respuesta *" title="Campo obligatorio" value="{{old('respuesta', $pregunta->respuesta)}}">
                    @if($errors->has('respuesta'))
                        <span class="support support-box support-respuesta error pl-1 font-bold w-full">{{$errors->first('respuesta')}}</span>
                    @else
                        <span class="support support-box support-respuesta error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="checkbox-obras w-8/12 mx-auto xl:w-6/12">
                    <ul class="obras my-8">
                        <li class="checkbox mx-auto w-8/12 md:w-7/12 lg:w-10/12">
                            <input name="privado" value="1" name="privado" {{ (old('privado', $pregunta->privado) && old('privado', $pregunta->privado) == 1) ? 'checked' : '' }} class="form-input filter filter-checkbox" id="privado" type="checkbox">
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
                    <input class="form-submit pregunta-editar btn btn-dos p-2 px-8 my-4" type="submit" value="Editar Evento">
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
    <script type="module" src="{{asset('js/pregunta/editar.js')}}"></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection