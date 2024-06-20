@if (isset($post) && $post->count() > 0)

	<!--palavra-->
	<section id="ultimos_cultos" class="area_palavra">

		<div class="title_section">ÚLTIMOS CULTOS</div>

		<div class="content">

			<div class="row">
				@foreach ($post as $culto)
					@php
						$meses = [1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril', 5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'];
						$data = strtotime($culto->data);
						$dia = date('d', $data);
						$mes = $meses[date('n', $data - 1)];
						$ano = date('Y', $data);
					@endphp

					<div class="col s4">
						<div class="card border-radius-20">
							<div class="card-image" style="height: 300px; overflow: hidden;">
								<img src="{{ route('home.cultos.show-image', $culto->id) }}" class="responsive-img">
								<div class="card-title" style="background-color: rgba(0, 0, 0, 0.3);">
									<a href="#" class="white-text"> {{ $culto->titulo }} </a>
								</div>
							</div>
							<div class="card-content">
								<div class="row">
									<div class="col s6 left-align">
										<small class="text_p">
											<i class="material-symbols-outlined">update</i>
											{{-- {{ $dia }} de {{ $mes }} de {{ $ano }} --}}
											{{ show_date($data) }}
										</small>
									</div>
									<div class="col s6 right-align">
										<small class="text_p right">
											<i class="material-symbols-outlined">person</i>
											{{ $culto->subtitulo }}
										</small>
									</div>
								</div>
							</div>
							<div class="card-action pl-1 pr-1 right-align">
								<a href="tete" class="light-green-text">Assistir</a><br>
							</div>
						</div>
					</div>
				@endforeach
			</div>

		</div>

		<a href="cultos.php">
			<div class="bt_ver_mais">Ver mais</div>
		</a>

	</section>
@endif
