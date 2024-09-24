<x-site-layout>

	<x-slot:body>

		<div class="title_page">EVENTOS</div>

		<div class="content_int">

			@if (isset($posts) && $posts->count() > 0)
				<div class="masonry row">
					@foreach ($posts as $i => $post)
						<div class="col s12 m6 l4">
							<a href="{{ route('site.eventos.details', $post->evento_slug) }}">
								<div class="card border-radius-20 z-depth-3">
									<div class="card-image">
										<div class="mascara" style="position: absolute; background: transparent; top: 0; left: 0; right: 0; bottom: 0; z-index: 9;"></div>
										<img src="{{ route('home.eventos.show-image', $post->id) . '?action=preview' }}">
									</div>
									<div class="card-content center-align gradient-0deg-grey-grey">
										<h5 class="card-title mb-6 mt-0">{{ $post->evento }}</h5>
										<small class="grey-text text-darken-3">{{ show_date($post->data_evento) }}</small>
										<p class="bold black-text mt-6">{{ $post->subtitulo }}</p>
									</div>
								</div>
							</a>
						</div>
					@endforeach
				</div>
			@else
				<div class="row">
					<div class="col s12">
						<p>Nenhuma postagem encontrado</p>
					</div>
				</div>
			@endif
		</div>

	</x-slot:body>

</x-site-layout>
