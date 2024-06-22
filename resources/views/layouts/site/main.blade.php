<x-app-layout>

	@if (isset($title))
		<x-slot:title>{{ $title }}</x-slot>
	@endif

	{{-- BEGIN Styles --}}
	<x-slot:styles>
		@include('layouts.site.styles')
	</x-slot:styles>
	{{-- END Styles --}}

	{{-- BGIN Header --}}
	@include('layouts.site.header')
	{{-- END Header --}}

	<main id="body">
		{{ $body }}
	</main>

	{{-- BEGIN Footer --}}
	@include('layouts.site.footer')
	{{-- END Footer --}}

	{{-- BEGIN scripts --}}
	@include('layouts.site.scripts')
	{{-- END scripts --}}

</x-app-layout>
