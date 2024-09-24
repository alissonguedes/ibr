<x-site-layout>

	<x-slot:body>

		<div class="title_page">MINISTÉRIOS</div>

		<div class="content_int mt-3">

			<div class="bloco">
				<div class="title_bloco_esquerdo">
					<div class="t1">{{ $post->titulo }}</div>
					<div class="t2">{{ $post->subtitulo }}</div>
				</div>
				<div class="conj_bloco">
					<div class="img_bloco_esq">
						<img src="{{ route('home.ministerios.show-image', $post->id) . '?action=preview' }}" class="img_cem">
					</div>
					<div class="text_bloco_esq">
						{!! $post->descricao !!}
					</div>
				</div>
			</div>

			@if (isset($ministerios) && $ministerios->count() > 0)
				<div class="outros_ministerios">

					<div class="subtitle_pages cor_cinza">Veja também
						<br>
						<span class="cor_verde">outros Ministérios</span>
					</div>

					<div class="area_ministerios">

						@foreach ($ministerios as $ministerio)
							<a href="{{ route('site.ministerios.details', $ministerio->titulo_slug) }}">
								<div class="conj_ministerios">
									<div class="img_min">
										<img src="{{ route('home.ministerios.show-image', $ministerio->id) . '?action=preview' }}" class="img_cem">
									</div>
									<div class="nome_ministerio cor_preta">{{ $ministerio->titulo }}</div>
									<div class="ref_ministerio cor_cinza">{{ $ministerio->subtitulo }}</div>
								</div>
							</a>
						@endforeach

					</div>

				</div>
			@endif

		</div>

	</x-slot:body>

</x-site-layout>
