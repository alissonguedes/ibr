@extends('clinica-v2.body')

@section('styles')
	@parent
	{!! includes('clinica.login.styles') !!}
	<style>
		.animated:not(.open) {
			display: none;
		}
	</style>
@endsection

@section('scripts')
	{!! includes('clinica.login.scripts') !!}
	<script defer>
		$(window).on('load', function() {
			setTimeout(function() {
				$('.animated').show();
				$('#splash').addClass('fadeOut');
				$('header .bg-header.animated').addClass('fadeInDown');
				$('footer .bg-header.animated').addClass('fadeInUp');
				$('.card-panel.login-card.animated').addClass('fadeIn');
				$('#user-login').find('[name="login"]').focus();

				setTimeout(function() {
					$('#splash').removeClass('open');
				}, 1000);

			}, 300);
		});
		// import {
		// 	SplashScreen
		// } from '@capacitor/splash-screen'

		// // await SplashScreen.hide();
		// // await SplashScreen.show({
		// // 	autoHide: false
		// // });

		// await SplashScreen.show({
		// 	showDuration: 5000,
		// 	autoHide: true
		// })
		console.log(window.Capacitor);
	</script>
@endsection

@section('content')
	<div id="page">

		<!-- Exibe apenas durante o primeiro carregamento da página -->
		<div id="splash" class="animated fast open delay-5">
			<div class="loading animated pulse infinite slower">
				<div class="logo">
					<img src="{{ asset('assets/img/site/logo/logo-white-h.png') }}" alt="">
				</div>
			</div>
		</div>

		<header>
			<div class="bg-header animated delay-5 fast"></div>
		</header>

		<div class="row">

			<div class="col s12">

				<div class="container">

					<div id="login-page" class="row">

						<div
							class="col s12 m6 l5 card-panel login-card z-depth-0 border-radius-10 transparent animated delay-20 padding-4">

							<form method="post" action="{{ route('clinica.account.auth.post') }}" id="login-form" class="" novalidate
								enctype="multipart/form-data" autocomplete="off">

								@csrf

								<div class="row">
									<div class="col s12">
										<h1 class="mt-0 center-align"><img src="{{ asset('assets/img/site/logo/logo.png') }}" alt=""
												class="responsive-img w-50"></h1>
									</div>
								</div>

								<div id="auth">

									<div class="row">
										<div class="col s12 mb-6">
											<h6 id="identificador" class="teal-text center-align text-darken2 animated">
												Bem vindo! Por favor, Informe seu usuário.
											</h6>
										</div>
									</div>

									<div id="user-login" class="animated">
										<div class="row">
											<div class="col s12 mb-6">
												<div class="input-field outlined border border-lighten-3 white no-border border-radius-15 z-depth-3">
													<label for="login">Usuário</label>
													<input type="email" name="login" id="login">
												</div>
											</div>
										</div>
									</div>

									<div id="user-pass" class="animated hide">
										<div class="row">
											<div class="col s12 mb-6">
												<div class="input-field outlined border border-lighten-3 white no-border border-radius-15 z-depth-3">
													<label for="senha">Senha</label>
													<input type="password" name="senha" id="senha" disabled="disabled">
												</div>
											</div>
										</div>
									</div>

								</div>

								<div class="row">
									<div class="col s12">
										<button type="submit" class="btn btn-large border-radius-15 red darken-2 col waves-effect">
											Próximo
										</button>
									</div>
								</div>

							</form>

						</div>

					</div>

				</div>

			</div>

		</div>

		<footer>
			<div class="bg-header animated fast delay-10"></div>
		</footer>

	</div>
@endsection
