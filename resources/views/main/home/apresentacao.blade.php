@if (isset($post))
	<div class="apresentacao">
		<div class="img_ap">
			<img src="{{ route('home.apresentacao.show-image', $post->id) }}" class="img_cem" style="background-color: transparent; border-radius: 100%;">
		</div>
		<div class="text_ap">
			<div class="title_ap bold">{{ $post->titulo }}</div>
			<div class="sub_ap">
				{{ $post->subtitulo }}
			</div>
			<div class="resumo_ap">
				{!! $post->conteudo !!}
			</div>
		</div>
	</div>
@endif
