<x-site-layout>

	<x-slot:body>

		<div class="title_page">A IBR</div>

		<div class="content_int">

			@if (isset($posts) && $posts->count() > 0)

				@foreach ($posts as $i => $post)
					@php
						$file = new App\Models\Admin\FileModel();
						$hasFile = $file->fileExists($post->id, 'post');
					@endphp

					<div class="bloco">
						<div class="@if ($i % 2 != 0) title_bloco_direito @else title_bloco_esquerdo @endif">
							<div class="t1 bold">{{ $post->subtitulo }}</div>
							<div class="t2 bold">{{ $post->titulo }}</div>
						</div>
						<div class="conj_bloco">
							@if ($hasFile)
								<div class="@if ($i % 2 != 0) img_bloco_dir @else img_bloco_esq @endif">
									<img src="{{ route('home.a-ibr.show-image', $post->id) . '?action=preview' }}" class="img_cem">
								</div>
							@endif
							<div class="@if ($i % 2 != 0) text_bloco_dir @else text_bloco_esq @endif">
								{!! $post->conteudo !!}
							</div>
						</div>
					</div>
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
