@extends('layout.home')

@section('css')
	<link rel="stylesheet" href={{ asset('css/poncho/icono-arg.css') }}>
    <link href={{ asset('css/tw.css') }} rel="stylesheet"/>
    <link href={{ asset('submodules/NotificationJS/css/styles.css') }} rel="stylesheet">
    <link href={{ asset('css/auth/ingresar.css') }} rel="stylesheet"/>
@endsection

@section('nav')
    @component('components.nav.global', ['current' => 'inicio'])
    @endcomponent
@endsection

@section('title')
    Ingresar a Mutualcoop
@endsection

@section('main')
    <section class="authentication w-full">
        <header class="md:flex md:justify-center background background-seis w-full flex-wrap">
            <section class="form-container mx-auto w-10/12 md:w-6/12 lg:w-5/12 px-6 py-12">
                <form id="ingresar" class="auth-form px-4 rounded-lg lg:px-4 rounded w-full bg-white" action="/ingresar" method="post"
                    data-rules="{{ json_encode($validation['ingresar']['rules']) }}"
                    data-messages="{{ json_encode($validation['ingresar']['messages']) }}">
                    <header>
                        <h2 class="text-2xl text-center py-8">Iniciar sesión</h2>
                    </header>
                    @csrf
                    <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                        <input name="dato"
                            class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Email o número de suscriptor *" title="Campo obligatorio" value="{{old('dato')}}">
                        @if ($errors->has("dato"))
                            <span class="support support-box support-dato error w-full">{{ $errors->first("dato") }}</span>
                        @else
                            <span class="support support-box support-dato error w-full"></span>
                        @endif
                    </div>
                    <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                        <label for='clave' class="ver-password">
                            <i class="fas fa-eye"></i>
                        </label>
                        <input id='clave' name="clave"
                            class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="password" placeholder="Contraseña *" title="Campo obligatorio" value="{{old('clave')}}">
                        @if ($errors->has("clave"))
                            <span class="support support-box support-clave error w-full">{{ $errors->first("clave") }}</span>
                        @else
                            <span class="support support-box support-clave error w-full"></span>
                        @endif
                    </div>
                    {{-- {!! app('captcha')->display() !!} --}}
                    {!! NoCaptcha::display() !!}
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="support support-box support-g-recaptcha-response error pl-1 font-bold">{{ $errors->first('g-recaptcha-response') }}</span>
                    @else
                        <span class="support support-box support-g-recaptcha-response error pl-1 font-bold"></span>
                    @endif
                    <div class="checkbox-obras w-8/12 mx-auto xl:w-8/12">
                        <ul class="obras my-8">
                            <li class="checkbox mx-auto w-8/12 md:w-7/12 lg:w-10/12">
                                <input name="recordar" value="1" name="recordar" {{ (is_array(old('recordar')) && in_array(1, old('recordad'))) ? 'checked' : '' }} class="form-input filter filter-checkbox" id="recordar" type="checkbox">
                                <label class="mt-2" for="recordar">Recordarme</label>
                            </li>
                        </ul>
                    </div>
                    <div class="flex items-center justify-center lg:justify-center py-4">
                        <button class="form-submit ingresar flex justify-center submit btn btn-dos p-2 px-8 my-4" type="submit">Ingresar</button>
                    </div>
                    <div class="loguear text-center pb-8">
                        <p>
                            <span>¿No tenés cuenta?</span>
                            <a class="change-view text text-tres" href="/registrar">Suscribirme</a>
                        </p>
                        <p>
                            <a class="change-view text text-tres" href="/cambiar-clave">¿Olvidaste tu contraseña?</a>
                        </p>
                    </div>
                </form>
            </section>
        </header>
    </section>
@endsection

@section('js')
    {!! NoCaptcha::renderJs() !!}
    <script>
        @if (Session::has('status'))
            const status = @json(Session::get('status'));
        @endif
        const validation = @json($validation);
    </script>
    <script type="module" src={{asset('/js/auth/ingresar.js')}}></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection