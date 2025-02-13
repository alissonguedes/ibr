<x-site-layout>

	<x-slot:body>

		<div class="title_page">MINISTÉRIOS</div>

		<div class="content_int">

			@if (isset($posts) && $posts->count() > 0)
				@foreach ($posts as $i => $post)
					<a href="@if (!isset($post->url)) {{ route('site.ministerios.details', $post->titulo_slug) }} @else {{ $post->url }} @endif" @if (isset($post->url)) target="_blank" @endif>
						<div class="conj_ministerios">
							<div class="img_min" style="background: none;">
								<img src="{{ route('home.ministerios.show-image', $post->id) . '?action=preview' }}" class="img_cem" >
							</div>
							{{-- <div class="nome_ministerio cor_preta">{{ $post->titulo }}</div> --}}
							{{-- <div class="ref_ministerio cor_cinza">{{ $post->subtitulo }}</div> --}}
							{{-- {!! $post->conteudo !!} --}}
						</div>
					</a>
				@endforeach
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
