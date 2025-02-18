<x-admin-layout>

	<x-slot:icon> cake </x-slot:icon>
	<x-slot:title> Aniversariantes </x-slot:title>

	<x-slot:body>

		@if (isset($posts) && $posts->count() > 0)
			@php
				$dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
			@endphp
			<div class="masonry row">
				@foreach ($posts as $post)
					<div class="masonry-item col s12 m6 l4">
						<div class="card border-radius-20">

							@if (!$post->status)
								<i class="inactive material-symbols-outlined"> visibility_off </i>
							@endif
							<div class="btn-group">
								<x-button class="btn activator btn-floating delete material-symbols-outlined font-weight-400">delete</x-button>
								<x-button class="icon-background edit" :data-href="route('admin.paginas.agenda.aniversarios.edit', $post->id)"> edit </x-button>
							</div>

							<div class="card-image">
								@php
									$sort_img = rand(0, 2);
								@endphp
								<img src="{{ asset('assets/img/cards/aniversario-' . $sort_img . '.jpg') }}" alt="">
							</div>

							<div class="card-stacked gradient-0deg-grey-grey">

								<div class="card-content center-align transparent grey-text">
									<h5 class="card-title bold mb-6 mt-0">{{ $post->titulo }}</h5>

									@php
										$horarios = [];
										$data = $post->data;
									@endphp

									{{ show_date($data) }}

								</div>

							</div>

							<div class="card-reveal red darken-4 white-text">
								<div class="row">
									<div class="col s12">
										Tem certeza que deseja remover este evento?
									</div>
								</div>
								<br>
								<br>
								<div class="row">
									<div class="col s6 left-align">
										<button class="btn card-title white black-text waves-effect" style="font-size: inherit; font-family: inherit;">Não</button>
									</div>
									<form action="{{ route('admin.paginas.agenda.aniversarios.delete') }}" method="post">
										@csrf
										<input type="hidden" name="_method" value="delete">
										<input type="hidden" name="id" value="{{ $post->id }}">
										<div class="col s6 right-align">
											<button class="btn red waves-effect">Sim</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@else
			<div class="row">
				<div class="col s12">
					Nenhum evento cadastrado.
				</div>
			</div>
		@endif

	</x-slot:body>

	@include('admin.paginas.agenda.aniversarios.form')

</x-admin-layout>
