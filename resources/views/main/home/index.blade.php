<x-site-layout>

	<x-slot:title>Página Inicial</x-slot:title>

	<x-slot:body>

		{!! slides('slideshow-container') !!}

		{!! post('main.home:apresentacao', 1) !!}

		{!! post('main.home:culto', 3) !!}

		{!! post('main.home:pastor', 6, ['table' => 'tb_pastor']) !!}

		{!! post('main.home:evento', 3) !!}

		<!--nosso templo-->
		<section class="nossotemplo">

			<div class="text_templo">
				<div class="title_templo1 cor cinza">Nosso novo</div>
				<div class="title_templo2 cor_verde">Templo</div>
				<div class="resumo_templo">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra tortor sem, at laoreet
					nisl condimentum et. Phasellus vitae pretium libero, eu sollicitudin massa.
				</div>
				<div id="bt_oferta" class="bt_oferta" data-element=".boxoferta">FAÇA SUA OFERTA</div>
			</div>
			<div class="img_templo">
				<img src="{{ asset('assets/img/novotemplo.png') }}" class="img_cem">
			</div>

		</section>

	</x-slot:body>

	<x-slot:script>
		<script defer src="{{ asset('assets/scripts/site/banner.js') }}"></script>
	</x-slot:script>

</x-site-layout>
