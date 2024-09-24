<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', config('site.og:locale') ?? app()->getLocale()) }}">

	<head>

		<meta charset="utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimal-ui">
		<meta name="description" content="{{ config('site.description') }}">
		<meta name="keywords" content="{{ config('site.keywords') }}">
		<meta name="author" content="{{ config('site.author') }}">
		<meta name="robots" content="{{ config('site.robots') }}">
		<meta name="theme-color" content="{{ config('site.theme-color', '#ff0000') }}">
		<meta rel="manifest" name="manifest.json">

		<meta property="og:title" content="{{ config('site.title') }}">
		<meta property="og:image" content="{{ config('site.logo') }}">
		<meta property="og:description" content="{{ config('site.description') }}">
		<meta property="og:url" content="{{ config('site.url') }}">
		<meta property="og:type" content="{{ config('site.type') }}">
		<meta property="og:locale" content="{{ config('site.locale') }}">
		<meta property="og:site_name" content="{{ config('site.title') }}">

		<link rel="preload" href="{{ asset('img/site/logo/logo-vertical.png') }}" as="image">
		<link rel="canonical" href="{{ config('site.url') }}">
		<link rel="manifest" href="{{ url('/webmainfest') }}">
		<link rel="shortcut icon" type="image/x-icon" href="{{ url('/favicon.ico') }}" />
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
		<link rel="icon" type="image/png" href="{{ url('/favicon-16x16.png') }}" sizes="16x16">
		<link rel="icon" type="image/png" href="{{ url('/favicon-32x32.png') }}" sizes="32x32">
		<link rel="icon" type="image/png" href="{{ url('/android-launcherincon-512-512.png') }}" sizes="512x512">
		<link rel="apple-touch-icon" type="image/png" href="{{ url('/apple-touch-icon.png') }}" sizes="180x180">

		{{-- @if (isset($styles))
			{{ $styles }}
		@endif --}}
		{{-- <link rel="stylesheet" src="{{ asset('mburger-webcomponent-2.0.0/dist/mburger.css') }}" type="module"></script> --}}
		<script src="{{ asset('assets/node_modules/mburger-webcomponent/dist/mburger/js/index.js') }}" type="module"></script>
		<link rel="stylesheet" href="{{ asset('assets/node_modules/mmenu-js/dist/mmenu.css') }}">

		<title>{{ config('site.title') . (isset($title) ? ' - ' . $title : null) }}</title>

		<style>
			* {
				box-sizing: border-box;
			}

			html,
			body {
				padding: 0;
				margin: 0;
			}

			body {
				background-color: #fff;
				font-family: Arial, Helvetica, Verdana;
				font-size: 16px;
				line-height: 22px;
				color: #666;
				position: relative;
				-webkit-text-size-adjust: none;
			}

			h1,
			h2,
			h3,
			h4,
			h5,
			h6 {
				margin: 1em 0;
				font-size: 22px;
			}

			p {
				margin: 1em 0;
			}

			a,
			a:link,
			a:active,
			a:visited,
			a:hover {
				color: inherit;
				text-decoration: underline;
			}

			nav:not(.mm-menu) {
				display: none;
			}

			header {
				position: sticky;
				height: 50px;
				padding: 0 80px;
				top: 0;
				font-size: 16px;
				font-weight: bold;
				color: #fff;
				line-height: 44px;
				text-align: center;
				background: #bba6a2;
			}

			header a {
				display: block;
				position: absolute;
				top: 0;
				left: 0;
				width: 80px;
				height: 50px;
				padding: 15px 25px;
			}

			header a:before,
			header a:after {
				content: "";
				display: block;
				background: #fff;
				height: 2px;
			}

			header a span {
				background: #fff;
				display: block;
				height: 2px;
				margin: 7px 0;
			}

			main {
				padding: 150px 50px 50px 50px;
				text-align: center;
			}
		</style>

		<style>
			mm-burger {
				--mb-bar-height: 2px;
				padding: 5px;
				border: 1px solid;
				border-radius: 5px;
			}
		</style>
	</head>

	<body>

		<div id="page">

			<header>
				<a href="#menu"><span></span></a>
				<mm-burger menu="menu" fx="collapse" ease="elastic">
					Menu
				</mm-burger>
			</header>

			<main>
				Main
			</main>

			<footer>
				Footer
			</footer>

		</div>

		<aside id="menu">
			<ul id="main-menu">
				<li><x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"> <i class="material-symbols-outlined">dashboard</i> {{ __('Dashboard') }}</x-nav-link></li>
				<li><x-nav-link :href="route('admin.categorias.index')" :active="request()->routeIs('admin.categorias.index')"> <i class="material-symbols-outlined">category</i> Categorias </x-nav-link> </li>
				<li class="active">
					<span> <i class="material-symbols-outlined">pages</i> Páginas </span>
					<ul id="paginas" class=" active">
						<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#main-menu"> Páginas </x-nav-link></li>
						<li class="active">
							<span> <i class="material-symbols-outlined">pages</i> Página Inicial </span>
							<ul id="home-page" class="">
								<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#paginas"> Página Inicial </x-nav-link></li>
								<li class="active">
									<x-nav-link :href="route('admin.paginas.home.banners.index')" :active="request()->routeIs('admin.paginas.home.banners.index') || request()->routeIs('admin.paginas.home.banners.edit')">
										<i class="material-symbols-outlined">wallpaper_slideshow</i>
										Banners
									</x-nav-link>
								</li>
								<li>
									<x-nav-link :href="route('admin.paginas.home.apresentacao.index')" :active="request()->routeIs('admin.paginas.home.apresentacao.index')">
										<i class="material-symbols-outlined">face</i>
										Apresentação
									</x-nav-link>
								</li>
								<li>
									<x-nav-link :href="route('admin.paginas.ministerios.index')" :active="request()->routeIs('admin.paginas.ministerios.index') || request()->routeIs('admin.paginas.ministerios.edit')">
										<i class="material-symbols-outlined">group</i>
										Corpo Pastoral
									</x-nav-link>
								</li>
							</ul>
						</li>
						<li><x-nav-link :href="route('admin.paginas.a-ibr.index')" :active="request()->routeIs('admin.paginas.a-ibr.index')"> <i class="material-symbols-outlined">church</i> A IBR</x-nav-link> </li>
						<li><x-nav-link :href="route('admin.paginas.ministerios.index')" :active="request()->routeIs('admin.paginas.ministerios.index') || request()->routeIs('admin.paginas.ministerios.edit')"> <i class="material-symbols-outlined">groups</i> Ministérios</x-nav-link></li>
						<li><x-nav-link :href="route('admin.paginas.cultos.index')" :active="request()->routeIs('admin.paginas.cultos.index') || request()->routeIs('admin.paginas.cultos.edit')"> <i class="material-symbols-outlined">diversity_3</i> Cultos </x-nav-link> </li>
						<li><x-nav-link :href="route('admin.paginas.eventos.index')" :active="request()->routeIs('admin.paginas.eventos.index') || request()->routeIs('admin.paginas.eventos.edit')"> <i class="material-symbols-outlined">event</i> Eventos </x-nav-link></li>
					</ul>
				</li>
			</ul>
		</aside>

		<script src="{{ asset('assets/node_modules/mmenu-js/dist/mmenu.js') }}"></script>

		<script>
			new Mmenu(document.querySelector("#menu"));

			document.addEventListener("click", function(evnt) {
				var anchor = evnt.target.closest('a[href="#/"]');
				if (anchor) {
					alert("Thank you for clicking, but that's a demo link.");
					evnt.preventDefault();
				}
			});
		</script>

		<script>
			const toggle = (event) => {
				const burger = event.target
					?.closest(".xmpl")
					?.querySelector("mm-burger");

				if (burger) {
					burger.state = burger.state === "cross" ? "bars" : "cross";
				}
			};
			document.addEventListener("click", toggle);
			document.addEventListener("keyup", (event) => {
				if (event.key === "Enter") {
					toggle(event);
				}
			});
		</script>

		<script>
			const burgers = document.querySelectorAll("mm-burger");
			const select = document.querySelector("#ease");
			select.addEventListener("change", () => {
				burgers.forEach((burger) => {
					burger.setAttribute("ease", select.value);
				});
			});
		</script>

	</body>

</html>
