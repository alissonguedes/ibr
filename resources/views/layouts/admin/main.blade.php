<x-app-layout>

	@if (isset($title))
		<x-slot:title>{{ $title }}</x-slot:title>
	@endif

	{{-- BEGIN Styles --}}
	<x-slot:styles>
		@include('layouts.admin.styles')
	</x-slot:styles>
	{{-- END Styles --}}

	{{-- BGIN Header --}}
	@include('layouts.admin.header')
	{{-- END Header --}}

	{{-- BGIN Sidebar --}}
	@include('layouts.admin.sidebar')
	{{-- END Sidebar --}}

	{{-- BEGIN Body --}}
	<main id="body" class="">

		@if (isset($main))
			{{ $main }}
		@else
			<div class="card card-panel no-padding no-margin">

				@if (isset($header))
					<section class="card-header animated fadeIn">
						{{ $header }}
					</section>
				@endif

				@if (isset($body))
					<div {{ $body->attributes->merge(['class' => 'card-content animated fadeIn']) }}>
						{{ $body }}
					</div>
				@endif

				@if (isset($form))
					<form enctype="multipart/form-data" {{ $form->attributes->merge(['class' => 'card-reveal no-padding']) }}>

						<div class="card card-panel no-border no-margin no-padding">

							@if (isset($form_tabs))
								<div {{ $form_tabs->attributes->merge(['class' => 'card-tabs']) }}>
									{{ $form_tabs }}
								</div>
							@endif

							<div class="card-content">
								{{ $form }}
							</div>

							@if (isset($card_footer))
								<div {{ $card_footer->attributes->merge(['class' => 'card-action right-align']) }}>
									{{ $card_footer }}
								</div>
							@endif

						</div>

						@isset($scripts_form)
							{{ $scripts_form }}
						@endisset

					</form>
				@endif

				@if (isset($footer))
					{{ $footer }}
				@endif

			</div>

		@endif

		@if (session()->has('message'))
			<x-toast class="green darken-4">{{ session()->get('message') }}</x-toast>
		@endif

		@if (count($errors) > 0)
			<x-toast class="red darken-2">Existem erros no formulário!</x-toast>
		@endif

	</main>
	{{-- END Body --}}

	{{-- BEGIN Footer --}}
	@include('layouts.admin.footer')
	{{-- END Footer --}}

	{{-- BEGIN Scripts --}}
	@include('layouts.admin.scripts')
	{{-- END Scripts --}}

	{{-- BEGIN Scripts --}}
	{{-- <x-slot:scripts>
		@include('layouts.admin.scripts')
		@if (isset($script))
			{{ $script }}
		@endif
	</x-slot:scripts> --}}
	{{-- END Scripts --}}

</x-app-layout>
