@extends('layout.panel')

@section('css')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ asset('css/poncho/icono-arg.css') }}">
    <link href={{ asset('css/tw.css') }} rel="stylesheet"/>
    <link href={{ asset('submodules/NotificationJS/css/styles.css') }} rel="stylesheet">
    <link href={{ asset('css/layout/panel.css') }} rel="stylesheet">
    <link href={{ asset('css/usuario/panel.css') }} rel="stylesheet">
@endsection

@section('title')
    Usuarios
@endsection

@section('nav')
	@component('components.nav.panel', ['current' => 'panel'])
	@endcomponent
@endsection

@section('main')
	<div id="tab" class="w-full relative tab-menu">
		<div class="floating-menu top left">

		</div>
		@component('components.nav.sidebar_tab', [
			'tabs' => $tabs,
		])
		@endcomponent

		<section class="tab-content-list w-full xl:mx-auto">
            @component('components.usuario.tabla', [
                'usuarios' => $usuarios,
                'niveles' => $niveles,
            ])
            @endcomponent
		</section>

		<div class="floating-menu top right">
			
		</div>

		<div class="floating-menu bottom right">
			<a href="#nav-1" class="floating-button sidebar-button open-btn btn btn-dos right">
				<i class="sidebar-icon fas fa-arrow-up"></i>
			</a>
		</div>

		@component('components.nav.sidebar_filters', [
            'filtros' => $filtros,
        ])
		@endcomponent
	</div>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection

@section('js')
    <script>
        const usuarios = @json($usuarios);
        const suscriptions = [];
    </script>
    <script type="module" src="{{ asset('js/usuario/panel.js') }}"></script>
@endsection