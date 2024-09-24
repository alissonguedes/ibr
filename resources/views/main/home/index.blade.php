<x-site-layout>

	<x-slot:title>Página Inicial</x-slot:title>

	<x-slot:body>

		{!! slides('slideshow-container') !!}

		{!! post('main.home:apresentacao', 1) !!}

		{!! post('main.home:culto', 3) !!}

		{{-- {!! post('main.home:pastor', 6) !!} --}}
		@include('main.home.pastor')

		{!! post('main.home:evento', 3) !!}

		{!! post('main.home:proposito') !!}

	</x-slot:body>

	<x-slot:script>
		<script defer src="{{ asset('assets/scripts/site/banner.js') }}"></script>
	</x-slot:script>

</x-site-layout>
