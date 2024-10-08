<x-app-layout>

	@if (isset($title))
		<x-slot:title>{{ $title }}</x-slot:title>
	@endif

	{{-- BEGIN Styles --}}
	<x-slot:styles>
		@include('layouts.clinica.styles')
	</x-slot:styles>
	{{-- END Styles --}}

	{{-- BGIN Header --}}
	@include('layouts.clinica.header')
	{{-- END Header --}}

	{{-- BGIN Sidebar --}}
	@include('layouts.clinica.sidebar')
	{{-- END Sidebar --}}

	{{-- BEGIN Body --}}
	<main id="body" class="">

		<div class="card no-padding no-margin">

			@if (isset($header))
				<section class="animated fadeIn">
					<header class="z-depth-0 border-bottom">
						{{ $header }}
					</header>
				</section>
			@endif

			<div class="card-content scroller animated fadeIn">
				@if (isset($body))
					{{ $body }}
				@endif
			</div>

			@if (isset($form))
				<form {{ $form->attributes->merge(['class' => 'card-reveal no-padding']) }}>

					@if (isset($form_tabs))
						<div {{ $form_tabs->attributes->merge(['class' => 'card-tabs']) }}>
							{{ $form_tabs }}
						</div>
					@endif

					<div class="card-content pl-1 pr-1 scroller">
						{{ $form }}
					</div>

					@if (isset($card_footer))
						<div {{ $card_footer->attributes->merge(['class' => 'card-action right-align']) }}>
							{{ $card_footer }}
						</div>
					@endif

					@isset($scripts_form)
						{{ $scripts_form }}
					@endisset

				</form>
			@endif

			@if (isset($footer))
				{{ $footer }}
			@endif

		</div>

		@if (session()->has('message'))
			<x-toast class="green darken-2">{{ session()->get('message') }}</x-toast>
		@endif

		@if (count($errors) > 0)
			<x-toast class="red darken-2">Existem erros no formulário!</x-toast>
		@endif

	</main>
	{{-- END Body --}}

	{{-- BEGIN Footer --}}
	@include('layouts.clinica.footer')
	{{-- END Footer --}}

	{{-- BEGIN Scripts --}}
	<x-slot:scripts>

		@include('layouts.clinica.scripts')

		@if (isset($script))
			{{ $script }}
		@endif

	</x-slot:scripts>
	{{-- END Scripts --}}

</x-app-layout>
