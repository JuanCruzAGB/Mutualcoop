@extends('layout.panel')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/poncho/icono-arg.css') }}">
    <link href={{ asset('css/tw.css') }} rel="stylesheet" />
    <link href={{ asset('css/auth/auth.css') }} rel="stylesheet" />
    <link href={{ asset('css/precio/editar.css') }} rel="stylesheet">
@endsection

@section('nav')
@component('components.nav.panel', ['current' => 'panel'])
@endcomponent
@endsection

@section('title')
    Editar Precio
@endsection

@section('main')
    <header class="md:flex md:justify-center background background-dos w-full">
        <section class="form-container mx-auto w-10/12 md:w-6/12 lg:w-5/12 background background-dos px-6">
            <form id="precio-editar" class="px-4 my-12 rounded-lg lg:px-4 rounded w-full bg-white none" action="/precio/{{$precio->id_precio}}/editar" method="post"
                data-rules="{{json_encode($validation->rules)}}"
                data-messages="{{json_encode($validation->messages)}}">
                <header>
                    <h2 class="text-2xl text-center py-8">Editar Precio</h2>
                </header>
                @csrf
                @method('PUT')
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="valor_semestral"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Valor Semestral *" title="Campo obligatorio" value="{{old('valor_semestral', $precio->valor_semestral)}}">
                    @if($errors->has('valor_semestral'))
                        <span class="support support-box support-valor_semestral error pl-1 font-bold w-full">{{$errors->first('valor_semestral')}}</span>
                    @else
                        <span class="support support-box support-valor_semestral error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="valor_anual"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Valor Anual *" title="Campo obligatorio" value="{{old('valor_anual', $precio->valor_anual)}}">
                    @if($errors->has('valor_anual'))
                        <span class="support support-box support-valor_anual error pl-1 font-bold w-full">{{$errors->first('valor_anual')}}</span>
                    @else
                        <span class="support support-box support-valor_anual error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="flex items-center justify-center lg:justify-center py-4">
                    <input class="form-submit precio-editar btn btn-dos p-2 px-8 my-4" type="submit" value="Editar Precio">
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
    <script type="module" src="{{asset('js/precio/editar.js')}}"></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection