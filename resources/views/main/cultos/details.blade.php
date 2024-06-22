<x-site-layout>

	<x-slot:body>

		{{-- <div class="title_page">CULTOS</div> --}}

		<div class="content_int">

			<div class="video_ministerio mt-3">
				{!! $post->url !!}
			</div>

			<style>
				iframe {
					width: 100% !important;
				}

				.video_ministerio iframe {
					height: 75vh !important;
					border: none !important;
				}
			</style>

			<div class="bloco">
				<div class="title_bloco_esquerdo">
					<div class="t1">{{ $post->titulo }}</div>
					<div class="data cor_verde">
						{{ show_date($post->data) }} - {{ $post->subtitulo }}</div>
				</div>
				<div class="conj_bloco">
					<div class="text_bloco">
						{!! $post->conteudo !!}
					</div>
				</div>
			</div>

			@if (isset($cultos) && $cultos->count() > 0)
				<div class="outros_ministerios">

					<div class="subtitle_pages cor_cinza">
						Veja também
						<br>
						<span class="cor_verde">Outros Cultos</span>
					</div>

					<div class="area_ministerios">

						<div class="row">
							@foreach ($cultos as $i => $culto)
								<div class="col s12 m6 l4">
									<a href="{{ route('site.cultos.details', $culto->titulo_slug) }}">
										<div class="card border-radius-20 z-depth-3">
											<div class="card-image" style="height: 300px; overflow: hidden;">
												<div class="mascara" style="position: absolute; background: transparent; top: 0; left: 0; right: 0; bottom: 0; z-index: 9;"></div>
												{!! $culto->url !!}
											</div>
											<div class="card-content center-align gradient-0deg-grey-grey">
												<h5 class="card-title mb-6 mt-0">{{ $culto->titulo }}</h5>
												<small class="grey-text text-darken-3">{{ date('d/m/Y', strtotime($culto->data)) }}</small>
												<p class="bold black-text mt-6">{{ $culto->subtitulo }}</p>
											</div>
										</div>
									</a>
								</div>
							@endforeach
						</div>
					</div>

				</div>
			@endif

		</div>

	</x-slot:body>

</x-site-layout>
