<x-app-layout>

	@if (isset($title))
		<x-slot:title>{{ $title }}</x-slot:title>
	@endif

	{{-- BEGIN Styles --}}
	<x-slot:styles>
		@include('layouts.admin.styles')
	</x-slot:styles>
	{{-- END Styles --}}

	<!-- Session Status -->
	<x-auth-session-status class="mb-4" :status="session('status')" />

	<form action="{{ route('login') }}" method="post">

		@csrf

		<!-- Email Address -->
		<div class="input-field">
			<x-input-label for="email" :value="__('Email')" />
			<x-text-input type="email" name="email" id="email" :value="old('email')" required autofocus autocomplete="username" />
			<x-input-error class="mt-2" :messages="$errors->get('email')" />
		</div>

		<!-- Password -->
		<div class="input-field">
			<x-input-label for="password" :value="__('Password')" />
			<x-text-input type="password" name="password" id="password" required autocomplete="current-password" />
			<x-input-error class="mt-2" :messages="$errors->get('password')" />
		</div>

		<!-- Remember Me -->
		<div class="input-field">
			<x-input-label for="remember_me" class="inline-flex items-center" />
			<input type="checkbox" name="remember" id="remember_me" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
			<span>{{ __('Remember me') }}</span>
		</div>

		<div class="input-field">
			@if (Route::has('password.request'))
				<a href="{{ route('password.request') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
					{{ __('Forgot your password?') }}
				</a>
			@endif

			<x-button type="submit" class="btn">
				login
			</x-button>
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

</x-app-layout>
