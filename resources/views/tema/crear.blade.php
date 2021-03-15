@extends('layout.panel')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/poncho/icono-arg.css') }}">
    <link href={{ asset('css/tw.css') }} rel="stylesheet" />
    <link href={{ asset('css/auth/auth.css') }} rel="stylesheet"/>
    <link href={{ asset('css/tema/crear.css') }} rel="stylesheet">
@endsection

@section('nav')
@component('components.nav.panel', ['current' => 'panel'])
@endcomponent
@endsection

@section('title')
    Crear Tema
@endsection

@section('main')
    <header class="md:flex md:justify-center background background-dos w-full">
        <section class="form-container mx-auto w-10/12 md:w-6/12 lg:w-5/12 background background-dos px-6">
            <form id="tema-crear" class="px-4 my-12 rounded-lg lg:px-4 rounded w-full bg-white none" action="/tema/crear" method="post"
                data-rules="{{json_encode($validation->rules)}}"
                data-messages="{{json_encode($validation->messages)}}">
                <header>
                    <h2 class="text-2xl text-center py-8">Crear Tema</h2>
                </header>
                @csrf
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="nombre"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Nombre *" title="Campo obligatorio" value="{{old('nombre')}}">
                    @if($errors->has('nombre'))
                        <span class="support support-box support-nombre error pl-1 font-bold w-full">{{$errors->first('nombre')}}</span>
                    @else
                        <span class="support support-box support-nombre error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="mb-4 flex justify-center flex-wrap mb-8 outline-none">
                    <select class="form-input p-3 outline-none bg-white" name="id_organismo" title="Campo obligatorio">
                        <option {{ !old("id_organismo") ? 'selected' : '' }} disabled>Organismo *</option>
                        <option value="1" {{ old("id_organismo") == 1 ? 'selected' : '' }}>INAES</option>
                        <option value="2" {{ old("id_organismo") == 2 ? 'selected' : '' }}>Otros organismos</option>
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
                <div class="flex items-center justify-center lg:justify-center py-4">
                    <input class="form-submit tema-crear btn btn-dos p-2 px-8 my-4" type="submit" value="Crear Categoría">
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
    <script type="module" src="{{asset('js/tema/crear.js')}}"></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection