<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.paginas.eventos.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Eventos </x-slot:title>

	<x-slot:body>

		@if (isset($posts) && $posts->count() > 0)
			<div class="masonry row">
				@foreach ($posts as $post)
					<div class="masonry-item col s12 m6 l4">
						<div class="card border-radius-20">

							<div class="card-image">
								@if (!$post->status)
									<i class="inactive material-symbols-outlined"> visibility_off </i>
								@endif
								@canany(['update', 'delete'], App\Models\Admin\EventoModel::class)
									<div class="btn-group">
										@can('delete', App\Models\Admin\EventoModel::class)
											<x-button class="btn activator btn-floating delete material-symbols-outlined font-weight-400">delete</x-button>
										@endcan
										@can('update', App\Models\Admin\EventoModel::class)
											<x-button class="icon-background edit" :data-href="route('admin.paginas.eventos.edit', $post->id)"> edit </x-button>
										@endcan
									</div>
								@endcan
								<img src="{{ route('home.eventos.show-image', $post->id) . '?action=preview' }}" height="210">
							</div>

							<div class="card-stacked gradient-0deg-grey-grey">

								<div class="card-content center-align transparent">
									<h5 class="card-title bold mb-6 mt-0">{{ $post->evento }}</h5>
									<small class="grey-text text-darken-3">{{ show_date($post->data_ini) }}</small>
									<p class="bold black-text mt-6">{{ $post->subtitulo }}</p>
									<br>
								</div>

								<div class="card-action transparent">
									<a href="{{ route('admin.paginas.eventos.inscritos', $post->id) }}" class="grey-text text-darken-4">
										<i class="material-symbols-outlined left">group</i>
										@php
											$inscricao = new App\Models\Admin\InscricaoModel();
											$total_inscritos = $inscricao->getInscritos($post->id)->count();
										@endphp
										{{ $total_inscritos }} Inscritos
									</a>
								</div>

							</div>
							@can('delete', App\Models\Admin\EventoModel::class)
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
										<form action="{{ route('admin.paginas.eventos.delete') }}" method="post">
											@csrf
											<input type="hidden" name="_method" value="delete">
											<input type="hidden" name="id" value="{{ $post->id }}">
											<div class="col s6 right-align">
												<button class="btn red waves-effect">Sim</button>
											</div>
										</form>
									</div>
								</div>
							@endcan
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

		<style>
			.daterangepicker {
				z-index: 9999999999 !important;
				position: relative;
				background-color: var(--grey-darken-5) !important;
			}

			.daterangepicker .calendar-table {
				background-color: inherit !important;
				border: 1px solid var(--grey-darken-5) !important;
			}
		</style>

	</x-slot:body>

	@include('admin.paginas.eventos.includes.form')

	@pushOnce('scripts')
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
		<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>
	@endPushOnce

</x-admin-layout>
