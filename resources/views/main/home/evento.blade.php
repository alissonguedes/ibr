@if (isset($post) && $post->count() > 0)
	<!--eventos-->
	<section class="eventos">
		<div class="title_section cor_verde">EVENTOS IBR</div>

		<div class="content">

			@dump($post)
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

		<a href="{{ route('site.eventos') }}">
			<div class="bt_ver_mais2">ver todos os eventos</div>
		</a>

	</section>
@endif
