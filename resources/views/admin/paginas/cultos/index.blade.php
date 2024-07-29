<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.paginas.cultos.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Cultos </x-slot:title>

	<x-slot:body>

		@if (isset($posts) && $posts->count() > 0)
			<div class="masonry row">
				@foreach ($posts as $post)
					<div class="masonry-item col s12 m6 l4">
						<div class="card border-radius-20">
							<div class="card-image" style="height: 300px; overflow: hidden;">
								@if (!$post->status)
									<i class="inactive material-symbols-outlined"> visibility_off </i>
								@endif

								@canany(['update', 'delete'], App\Models\Admin\CultoModel::class)
									<div class="btn-group">
										@can('delete', App\Models\Admin\CultoModel::class)
											<x-button class="btn activator btn-floating delete material-symbols-outlined font-weight-400">delete</x-button>
										@endcan
										@can('update', App\Models\Admin\CultoModel::class)
											<x-button class="icon-background edit" :data-href="route('admin.paginas.cultos.edit', $post->id)"> edit </x-button>
										@endcan
									</div>
								@endcan

								<img src="{{ route('home.cultos.show-image', $post->id) . '?action=preview' }}">
							</div>

							<div class="card-content center-align gradient-0deg-grey-grey">
								<h5 class="card-title bold mb-6 mt-0">{{ $post->titulo }}</h5>
								<small class="grey-text text-darken-3">{{ date('d/m/Y', strtotime($post->data)) }}</small>
								<p class="bold black-text mt-6">{{ $post->subtitulo }}</p>
							</div>

							<div class="card-reveal red darken-4 white-text">
								<div class="row">
									<div class="col s12">
										Tem certeza que deseja remover este culto?
									</div>
								</div>
								<br>
								<br>
								<div class="row">
									<div class="col s6 left-align">
										<button class="btn card-title white black-text waves-effect" style="font-size: inherit; font-family: inherit;">Não</button>
									</div>
									<form action="{{ route('admin.paginas.cultos.delete') }}" method="post">
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
					Nenhum culto cadastrado.
				</div>
			</div>
		@endif

	</x-slot:body>

	@include('admin.paginas.cultos.includes.form')

	@pushOnce('scripts')
		<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.min.js') }}"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>
	@endPushOnce

</x-admin-layout>
