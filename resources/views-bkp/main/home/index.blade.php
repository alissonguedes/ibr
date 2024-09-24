@extends('main.main')

@section('main')
	<!--banners-->
	<div id="slideshow-container">
		<div class="mySlides">
			<img src="{{ asset('assets/img/slides/img1.jpg') }}" alt="Image 1">
		</div>

		<div class="mySlides">
			<img src="{{ asset('assets/img/slides/img2.jpg') }}" alt="Image 2">
		</div>

		<div class="mySlides">
			<img src="{{ asset('assets/img/slides/img3.jpg') }}" alt="Image 3">
		</div>

		<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
		<a class="next" onclick="plusSlides(1)">&#10095;</a>
	</div>

	<!--base1-->
	<div class="base_slide"><img src="{{ asset('assets/img/base_slide.png') }}" class="img_cem"></div>

	<div class="apresentacao">
		<div class="img_ap"><img src="{{ asset('assets/img/pastorwalber.png') }}" class="img_cem"></div>
		<div class="text_ap">
			<div class="title_ap">O que acreditamos</div>
			<div class="sub_ap">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce magna massa.
			</div>
			<div class="resumo_ap">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce magna massa,
				condimentum at eleifend eu, semper a arcu. Phasellus dictum sem et urna malesuada pellentesque.
				Sed nisi enim, laoreet non justo id, commodo dapibus enim.
			</div>
		</div>
	</div>

	<!--palavra-->
	<section class="area_palavra">

		<div class="title_section">ÚLTIMOS CULTOS</div>
		<div class="content">
			<!--conj palavra-->
			<a href="culto_page.php">
				<div class="conj_palavra">
					<div class="img_palavra"><img src="{{ asset('assets/img/palavra/001.jpg') }}" class="img_cem"></div>
					<div class="datapastor">
						<div class="data">
							<div class="icon_p"><img src="{{ asset('assets/img/icon_data.jpg') }}" class="img_cem"></div>
							<div class="text_p">16 de outubro de 2023</div>
						</div>
						<div class="pastor">
							<div class="icon_p"><img src="{{ asset('assets/img/icon_pastor.jpg') }}" class="img_cem"></div>
							<div class="text_p">Pastor Walber</div>
						</div>
					</div>
					<div class="title_palavra">Disciplina na Igreja - Parte I</div>
					<div class="resumo_palavra">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
						magna massa...
					</div>
				</div>
			</a>

			<!--conj palavra-->
			<a href="culto_page.php">
				<div class="conj_palavra">
					<div class="img_palavra"><img src="{{ asset('assets/img/palavra/001.jpg') }}" class="img_cem"></div>
					<div class="datapastor">
						<div class="data">
							<div class="icon_p"><img src="{{ asset('assets/img/icon_data.jpg') }}" class="img_cem"></div>
							<div class="text_p">16 de outubro de 2023</div>
						</div>
						<div class="pastor">
							<div class="icon_p"><img src="{{ asset('assets/img/icon_pastor.jpg') }}" class="img_cem"></div>
							<div class="text_p">Pastor Walber</div>
						</div>
					</div>
					<div class="title_palavra">Disciplina na Igreja - Parte I</div>
					<div class="resumo_palavra">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
						magna massa...
					</div>
				</div>
			</a>

			<!--conj palavra-->
			<a href="culto_page.php">
				<div class="conj_palavra">
					<div class="img_palavra"><img src="{{ asset('assets/img/palavra/001.jpg') }}" class="img_cem"></div>
					<div class="datapastor">
						<div class="data">
							<div class="icon_p"><img src="{{ asset('assets/img/icon_data.jpg') }}" class="img_cem"></div>
							<div class="text_p">16 de outubro de 2023</div>
						</div>
						<div class="pastor">
							<div class="icon_p"><img src="{{ asset('assets/img/icon_pastor.jpg') }}" class="img_cem">
							</div>
							<div class="text_p">Pastor Walber</div>
						</div>
					</div>
					<div class="title_palavra">Disciplina na Igreja - Parte I</div>
					<div class="resumo_palavra">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
						magna massa...
					</div>
				</div>
			</a>

		</div>

		<a href="cultos.php">
			<div class="bt_ver_mais">ver mais</div>
		</a>

	</section>

	<!--corpo pastoral-->
	<section class="corpo_pastoral">

		<div class="title_section">CORPO PASTORAL</div>
		<div class="content">

			<div class="conj_pastor">
				<div class="img_pr"><img src="{{ asset('assets/img/pastor.jpg') }}" class="img_cem"></div>
				<div class="nome_pr">Pastor Walber Barbosa</div>
			</div>

			<div class="conj_pastor">
				<div class="img_pr"><img src="{{ asset('assets/img/pastor.jpg') }}" class="img_cem"></div>
				<div class="nome_pr">Pastor Walber Barbosa</div>
			</div>

			<div class="conj_pastor">
				<div class="img_pr"><img src="{{ asset('assets/img/pastor.jpg') }}" class="img_cem"></div>
				<div class="nome_pr">Pastor Walber Barbosa</div>
			</div>

			<div class="conj_pastor">
				<div class="img_pr"><img src="{{ asset('assets/img/pastor.jpg') }}" class="img_cem"></div>
				<div class="nome_pr">Pastor Walber Barbosa</div>
			</div>

		</div>

	</section>

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
@endsection
