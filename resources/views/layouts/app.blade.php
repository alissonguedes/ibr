@php

	$config = new App\Models\ConfigModel();

	config($config->getAllConf());

@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', config('site.site_og:locale') ?? app()->getLocale()) }}">

	<head>

		<meta charset="utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimal-ui">
		<meta name="description" content="{{ config('site.site_description') }}">
		<meta name="keywords" content="{{ config('site.site_keywords') }}">
		<meta name="author" content="{{ config('site.site_author') }}">
		<meta name="robots" content="{{ config('site.site_robots') }}">
		<meta name="theme-color" content="{{ config('site.site_theme-color', 'var(--light-green)') }}">
		<meta rel="manifest" name="manifest.json">

		<meta property="og:title" content="{{ config('site.site_title') }}">
		<meta property="og:image" content="{{ config('site.site_logo') }}">
		<meta property="og:description" content="{{ config('site.site_description') }}">
		<meta property="og:url" content="{{ config('site.site_url') }}">
		<meta property="og:type" content="{{ config('site.site_type') }}">
		<meta property="og:locale" content="{{ config('site.site_locale') }}">
		<meta property="og:site_name" content="{{ config('site.site_title') }}">

		<link rel="preload" href="{{ asset('img/logo1.png') }}" as="image">
		<link rel="canonical" href="{{ config('site.site_url') }}">
		<link rel="manifest" href="{{ url('/webmainfest') }}">
		<link rel="shortcut icon" type="image/x-icon" href="{{ url('/favicon.ico') }}" />
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
		<link rel="icon" type="image/png" href="{{ url('/favicon-16x16.png') }}" sizes="16x16">
		<link rel="icon" type="image/png" href="{{ url('/favicon-32x32.png') }}" sizes="32x32">
		<link rel="icon" type="image/png" href="{{ url('/android-launcherincon-512-512.png') }}" sizes="512x512">
		<link rel="apple-touch-icon" type="image/png" href="{{ url('/apple-touch-icon.png') }}" sizes="180x180">
		<link rel="stylesheet" href="{{ asset('assets/node_modules/pace-js/pace-theme-default.min.css') }}">

		@if (isset($styles))
			{{ $styles }}
		@endif

		<title>{{ config('site.site_title') . (isset($title) ? ' - ' . $title : null) }}</title>

		<script src="{{ asset('assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/materialize/materialize.js') }}"></script>
		<script src="{{ asset('assets/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
		<script src="{{ asset('assets/node_modules/mmenu-js/dist/mmenu.js') }}"></script>
		<script src="{{ asset('assets/node_modules/pace-js/pace.min.js') }}"></script>

		@vite(['resources/css/app.css', 'resources/js/app.js'])

	</head>

	<body class="dark-theme">

		<div class="progress">
			<div class="indeterminate-center"></div>
		</div>

		{{-- BEGIN #Page --}}
		<div id="page">

			{{ $slot }}

			@if (isset($sidebar))
				<aside {{ $sidebar->attributes->merge(['class' => 'sidenav-main nav-expanded nav-lock nav-collapsible']) }}>
					{{ $sidebar }}
				</aside>
			@endif

		</div>
		{{-- END #Page --}}

		<script src="{{ asset('assets/node_modules/pace-js/pace.min.js') }}"></script>

	</body>

</html>
