<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="{{ asset('assets/node_modules/materialize-css/dist/css/materialize.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/node_modules/froala-editor/css/froala_editor.pkgd.min.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/node_modules/froala-editor/css/themes/dark.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/node_modules/froala-editor/css/themes/gray.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/node_modules/froala-editor/css/themes/royal.min.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/css/defaults/fonts.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/defaults/defaults.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/defaults/materialize.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/defaults/colors.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/defaults/animate.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

<style>
	aside {
		position: fixed;
		top: 0;
		height: 100%;
		color: rgba(0, 0, 0, 0.6);
		background-color: #ffffff;
		z-index: 9999999;
		overflow: hidden;
	}

	aside.sidenav-dark,
	aside.sidenav-dark .application-logo {
		/* color: rgba(255, 255, 255, 1); */
		color: rgba(255, 255, 255, 0.6);
		/* background-color: rgba(255, 255, 255, 0.01); */
		background-color: #101215;
	}

	aside.sidenav-dark {
		background-color: #090909;
	}

	.sidenav {
		transition: all 200ms;
	}

	.nav-collapsed .sidenav {
		width: 60px;
	}

	.nav-collapsed .sidenav .application-logo,
	.nav-collapsed .sidenav ul li a.submenu-open:after {
		display: none;
	}

	.nav-collapsed .sidenav .sidenav {
		width: inherit;
		transform: translateX(0);
	}

	.sidenav ul {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		transform: translate(100%, 0);
		transition: transform 0.6s ease;
		-webkit-transition: -webkit-transform 0.5s ease;
	}

	.sidenav,
	.sidenav ul {
		background-color: inherit !important;
		color: inherit !important;
	}

	.sidenav ul.in {
		opacity: 1;
		display: block;
		-webkit-transform: translate3d(0, 0, 0);
		-moz-transform: translate3d(0, 0, 0);
		-ms-transform: translate3d(0, 0, 0);
		-o-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	}

	.sidenav ul.out {
		opacity: 1;
		display: block;
		-webkit-transform: translate3d(-30%, 0, 0);
		-moz-transform: translate3d(-30%, 0, 0);
		-ms-transform: translate3d(-30%, 0, 0);
		-o-transform: translate3d(-30%, 0, 0);
		transform: translate3d(-30%, 0, 0);
	}

	.sidenav ul li {
		display: block;
		position: relative;
		margin: 10px 10px 0 0;
		border-radius: 0 24px 24px 0;
	}

	.sidenav ul li a,
	.sidenav li>a>i,
	.sidenav li>a>[class^="mdi-"],
	.sidenav li>a li>a>[class*="mdi-"],
	.sidenav li>a>i.material-icons,
	.sidenav li>a>i.material-symbols-outlined,
	.sidenav li>a>i.material-symbols-outlined {
		line-height: 48px;
		letter-spacing: 0.5px;
		color: inherit !important;
		margin: 0;
		font-weight: 300;
	}

	.sidenav li>a>i.material-icons,
	.sidenav li>a>i.material-symbols-outlined,
	.sidenav li>a>i.material-symbols-outlined {
		margin-right: 15px;
	}

	.sidenav li>a,
	.sidenav ul li a,
	.sidenav ul li span {
		display: block !important;
		padding: 0 20px 0;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		color: inherit;
		display: block;
		margin: 0;
		-webkit-transition: all 0.25s;
		-moz-transition: all 0.25s;
		transition: all 0.25s;
		border-radius: inherit;
	}

	.sidenav ul li a.submenu-open:after {
		content: '';
		border: 2px solid transparent;
		border-color: rgba(255, 255, 255, 0.6);
		display: block;
		width: 7px;
		height: 7px;
		margin-bottom: -3px;
		position: absolute;
		bottom: 50%;
		-webkit-transform: rotate(-45deg);
		-moz-transform: rotate(-45deg);
		-ms-transform: rotate(-45deg);
		-o-transform: rotate(-45deg);
		transform: rotate(-45deg);
		border-top: none;
		border-left: none;
		right: 18px;
	}

	.sidenav ul li a.menu-close,
	.sidenav ul li span.menu-close {
		text-indent: 40px;
		margin-top: 0px;
	}

	.sidenav ul li a.menu-close:before {
		content: '';
		border: 2px solid transparent;
		display: block;
		width: 7px;
		height: 7px;
		margin-bottom: -3px;
		position: absolute;
		bottom: 50%;
		-webkit-transform: rotate(-45deg);
		-moz-transform: rotate(-45deg);
		-ms-transform: rotate(-45deg);
		-o-transform: rotate(-45deg);
		transform: rotate(-45deg);
		border-right: none;
		border-bottom: none;
		left: 30px;
	}

	.menu-close {
		background-color: rgba(0, 0, 0, 0.1);
	}

	.sidenav ul li a.menu-close,
	.sidenav ul li span.menu-close,
	.sidenav ul li a.menu-close:before {
		border-color: rgba(255, 255, 255, 0.3) !important;
		color: rgba(255, 255, 255, 0.3) !important;
	}

	.sidenav ul li:hover>a:not(.menu-close),
	.sidenav ul li:hover>span {
		background-color: rgba(0, 0, 0, 0.1) !important;
		/* color: #fff !important; */
	}

	.sidenav ul li a:not(.menu-close).active:hover,
	.sidenav li a:not(.menu-close).active {
		color: #fff !important;
	}

	.sidenav ul li a:hover.menu-close:before,
	.sidenav ul li a:hover.submenu-open:after {
		/* border-color: rgba(0, 0, 0, 1) !important; */
		/* border-color: rgba(0, 0, 0, 1) !important; */
	}

	@media only screen and (min-width: 601px) {

		nav,
		nav .nav-wrapper i,
		nav a.sidenav-trigger,
		nav a.sidenav-trigger i {
			line-height: 64px;
			height: 64px;
		}
	}

	@media screen and (min-width: 992px) {
		nav ul li.search.search-open {
			width: calc(100% - 300px);
			color: rgba(0, 0, 0, 0.3);
		}
	}

	@media screen and (max-width: 992px) {
		.sidenav-main {
			width: 0;
		}

		header nav {
			padding-left: 60px;
		}

		#input-search-header {
			width: calc(100% - 40px);
			padding: 0 20px 0 20px;
		}

		main {
			padding-left: 0;
			padding-right: 64px;
		}

		.nav-collapsed aside {
			width: auto;
		}

		.nav-collapsed aside .sidenav {
			width: 300px;
			transform: translateX(-105%);
		}

		.application-logo:before,
		.navbar-main:after,
		nav ul li {
			border: none;
		}

		.navbar-nav {
			position: fixed;
			bottom: 0;
			left: 2%;
			right: 2%;
			width: 94%;
			height: 52px;
			background-color: var(--red-lighten-1);
			color: #fff;
			margin: 0 auto;
			padding: 0px 5px 0 5px !important;
			display: flex;
			place-content: space-between;
			align-items: center;
			border-radius: 50px 50px 0px 0px;
		}

		.navbar-nav .logo span {
			position: relative;
			top: -25px;
			display: block;
			width: 45px;
			height: 45px;
			border-radius: 100%;
			background-image: url("{{ asset('assets/img/logo/coracao.png') }}");
			background-repeat: no-repeat;
			background-size: contain;
			background-position: bottom;
		}

		.navbar-nav .logo span::after {
			content: '';
			width: 60px;
			height: 60px;
			position: absolute;
			background-color: #ffffff;
			background-repeat: no-repeat;
			background-size: 100%;
			background-position: center;
			left: 50%;
			right: 50%;
			top: 50%;
			bottom: 50%;
			border-radius: 100%;
			margin-left: -30px;
			margin-right: -30px;
			margin-top: -30px;
			margin-bottom: -30px;
			z-index: -1;
		}

		.navbar-nav li {
			display: flex;
			align-items: center;
			place-content: center;
			flex: 1 1 100%;
		}

		.navbar-nav a,
		.navbar-nav .sidenav-trigger {
			width: 45px !important;
			height: 45px !important;
			line-height: 42px !important;
			padding: 0;
			background-color: transparent !important;
			box-shadow: none;
			text-align: center;
			display: flex;
			border-radius: 100%;
			align-items: center;
		}

		.navbar-nav a i,
		.navbar-nav .sidenav-trigger i {
			width: inherit;
			height: inherit;
			line-height: inherit;
			margin: 0;
			padding: 0;
			font-size: 24px;
		}
	}
</style>
