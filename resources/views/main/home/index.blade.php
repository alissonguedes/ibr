<x-site-layout>

	<x-slot:title>Página Inicial</x-slot:title>

	<x-slot:body>

		{!! slides('slideshow-container') !!}

		{!! post('main.home:apresentacao', 1) !!}

		{!! post('main.home:cultos', 3) !!}

		{!! post('main.home:pastores', 6, ['table' => 'tb_pastor']) !!}

		<!--eventos-->
		<section class="eventos">
			<div class="title_section cor_verde">EVENTOS IBR</div>

			<div class="content">

				<!--conj palavra-->
				<a href="evento_page.php">
					<div class="conj_palavra">
						<div class="img_palavra"><img src="{{ asset('assets/img/eventos/001.jpg') }}" class="img_cem"></div>
						<div class="title_palavra">Acamp-X<br>Incendiários</div>
						<div class="resumo_palavra">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
							magna massa...</div>
					</div>
				</a>

				<!--conj palavra-->
				<a href="evento_page.php">
					<div class="conj_palavra">
						<div class="img_palavra"><img src="{{ asset('assets/img/eventos/001.jpg') }}" class="img_cem"></div>
						<div class="title_palavra">Acamp-X<br>Incendiários</div>
						<div class="resumo_palavra">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
							magna massa...</div>
					</div>
				</a>

				<!--conj palavra-->
				<a href="evento_page.php">
					<div class="conj_palavra">
						<div class="img_palavra"><img src="{{ asset('assets/img/eventos/001.jpg') }}" class="img_cem"></div>
						<div class="title_palavra">Acamp-X<br>Incendiários</div>
						<div class="resumo_palavra">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
							magna massa...</div>
					</div>
				</a>

			</div>

			<a href="eventos.php">
				<div class="bt_ver_mais2">ver todos os eventos</div>
			</a>

		</section>

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
