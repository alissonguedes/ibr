@if (isset($post) && $post->count() > 0)
	<!--eventos-->
	<section class="eventos">
		<div class="title_section cor_verde">EVENTOS IBR</div>

		<div class="content">

			@foreach ($post as $p)
				<!--conj palavra-->
				<a href="{{ route('site.eventos.details', $p->evento_slug) }}">
					<div class="conj_palavra">
						<div class="img_palavra"><img src="{{ route('home.eventos.show-image', $p->id) }}" class="img_cem"></div>
						<div class="title_palavra" style="height: 60px;" title="{{ $p->evento }}">{{ $p->evento }}</div>
						<div class="resumo_palavra">
							{{ $p->local_evento }}
						</div>
					</div>
				</a>
			@endforeach

		</div>

		<a href="{{ route('site.eventos') }}">
			<div class="bt_ver_mais2">ver todos os eventos</div>
		</a>

	</section>
@endif
