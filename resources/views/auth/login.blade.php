<x-app-layout>

	@if (isset($title))
		<x-slot:title>{{ $title }}</x-slot:title>
	@endif

	{{-- BEGIN Styles --}}
	<x-slot:styles>
		@include('layouts.admin.styles')
		<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
	</x-slot:styles>
	{{-- END Styles --}}

	<!-- Session Status -->
	<x-auth-session-status class="mb-4" :status="session('status')" />

	<div class="bloco_central">

		<div class="bloco_branco">

			<div class="img_bloco">
				<img src="{{ asset('assets/img/admin/bg_login.png') }}" class="img_cem">
			</div>

			<div class="area_form">

				<div class="logo_empresa">
					<img src="{{ asset('assets/img/admin/logo_admin.png') }}" class="img_cem">
				</div>

				<form action="{{ route('login') }}" method="post" class="bloco_form" autocomplete="off">

					@csrf

					<!-- Email Address -->
					<div class="input-field">
						{{-- <x-input-label for="email" class="active":value="__('Usuário')" /> --}}
						<x-text-input type="email" name="email" id="email" class="black-text" :value="old('email')" required autofocus placeholder="Usuário" />
						<x-input-error class="mt-2" :messages="$errors->get('email')" />
					</div>

					<!-- Password -->
					<div class="input-field">
						{{-- <x-input-label for="password" class="active" :value="__('Senha')" /> --}}
						<x-text-input type="password" name="password" id="password" class="black-text" required placeholder="Senha" />
						<x-input-error class="mt-2" :messages="$errors->get('password')" />
					</div>

					<!-- Remember Me -->
					{{-- <div class="input-field">
						<x-input-label for="remember_me" class="inline-flex items-center" />
						<input type="checkbox" name="remember" id="remember_me" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
						<span>{{ __('Remember me') }}</span>
					</div> --}}

					<div class="input-field">
						{{-- @if (Route::has('password.request'))
							<a href="{{ route('password.request') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
								{{ __('Recuperar senha') }}
							</a>
						@endif --}}
						<button type="submit" class="btn">
							login
						</button>
					</div>

				</form>

				@if (session()->has('message'))
					<x-toast class="green darken-4">{{ session()->get('message') }}</x-toast>
				@endif

				@if (count($errors) > 0)
					<x-toast class="red darken-2">Existem erros no formulário!</x-toast>
				@endif

				{{-- BEGIN Scripts --}}
				<x-slot:scripts>

					@include('layouts.admin.scripts')

					@if (isset($script))
						{{ $script }}
					@endif

				</x-slot:scripts>
				{{-- END Scripts --}}

			</div>

		</div>

	</div>

</x-app-layout>
