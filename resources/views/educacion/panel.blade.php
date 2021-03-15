@extends('layout.panel')

@section('css')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ asset('css/poncho/icono-arg.css') }}">
    <link href={{ asset('css/tw.css') }} rel="stylesheet"/>
    <link href={{ asset('submodules/NotificationJS/css/styles.css') }} rel="stylesheet">
    <link href={{ asset('css/layout/panel.css') }} rel="stylesheet">
    <link href={{ asset('css/educacion/panel.css') }} rel="stylesheet">
@endsection

@section('title')
    Notas de Interés
@endsection

@section('nav')
@component('components.nav.panel', ['current' => 'panel'])
@endcomponent
@endsection

@section('main')
	<div id="tab" class="w-full relative tab-menu">
		<div class="floating-menu top left">
			<a href="#tab" class="floating-button sidebar-button open-btn btn btn-dos left">
				<span class="link-text">Menú</span>
				<i class="sidebar-icon fas fa-bars"></i>
			</a>
		</div>
		@component('components.nav.sidebar_tab', [
			'tabs' => $tabs,
		])
		@endcomponent

		<section class="tab-content-list w-full xl:mx-auto">
            @component('components.educacion.tabla', [
                'educaciones' => $educaciones,
            ])
            @endcomponent
		</section>

		<div class="floating-menu top right">
			<a href="#filters" class="floating-button sidebar-button open-btn btn btn-dos right">
				<i class="sidebar-icon fas fa-filter"></i>
				<span class="link-text">Filtros</span>
			</a>
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
        const educaciones = @json($educaciones);
        const suscriptions = [];
    </script>
    <script type="module" src="{{ asset('js/educacion/panel.js') }}"></script>
@endsection