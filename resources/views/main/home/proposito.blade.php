@if (isset($post))

	<!--nosso templo-->
	<section class="nossotemplo">

		<div class="text_templo">
			<div class="title_templo1 cor cinza bold" style="top: 30px;">
				{{ $post->titulo }}
			</div>
			<div class="title_templo2 cor_verde">{{ $post->subtitulo }}</div>
			<div class="resumo_templo">
				{!! $post->conteudo !!}
			</div>
			@if (isset($post->url))
				{{-- <a href="{{ $post->url }}" id="bt_oferta" class="bt_oferta" data-element=".boxoferta" style="display: block;">
					{{ $post->texto_url }}
				</a> --}}
				<button class="modal-trigger btn black-text light-green" style="width: 100%; display: block;" data-target="modal_qrcode">{{ $post->texto_url }}</button>
			@endif
		</div>

		<div class="img_templo">
			<img src="{{ route('home.propositos.show-image', $post->id) }}" class="img_cem">
		</div>

	</section>

	<div id="modal_qrcode" class="modal">
		<div class="modal-content">
			<img src="#" alt="qrcode">
		</div>
		<div class="modal-footer">
			<div class="row">
				<div class="col s12">
					<button class="btn light-green modal-close">Fechar</button>
				</div>
			</div>
		</div>
	</div>

	@pushOnce('scripts')
		<script>
			$(function() {
				$('#modal_qrcode').modal();
			});
		</script>
	@endPushOnce

@endif
