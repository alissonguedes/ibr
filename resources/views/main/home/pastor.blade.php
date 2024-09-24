@php

	$pastor = new App\Models\Admin\PastorModel();
	$pastores = $pastor->getAllActivePosts();

@endphp

@if ($pastores->count() > 0)

	<!--corpo pastoral-->
	<section class="corpo_pastoral">

		<div class="title_section">CORPO PASTORAL</div>
		<div class="content">

			@foreach ($pastores as $pastor)
				<div class="conj_pastor">
					<div class="img_pr responsive-img circle">
						<img src="{{ route('home.pastores.show-image', $pastor->id) }}" class="img_cem">
					</div>
					<div class="nome_pr">{{ $pastor->nome }}</div>
				</div>
			@endforeach

		</div>

	</section>

@endif
