<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.paginas.ministerios.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Ministérios </x-slot:title>

	<x-slot:body>

		@if (isset($posts) && $posts->count() > 0)
			<div class="masonry row">
				@foreach ($posts as $post)
					<div class="masonry-item col s12 m6 l3 xl4">
						<div class="card border-radius-20">

							<div class="card-image">
								@if (!$post->status)
									<i class="inactive material-symbols-outlined"> visibility_off </i>
								@endif

								@canany(['update', 'delete'], App\Models\Admin\MinisterioModel::class)
									<div class="btn-group">
										@can('delete', App\Models\Admin\MinisterioModel::class)
											<x-button class="btn activator btn-floating delete material-symbols-outlined font-weight-400">delete</x-button>
										@endcan
										@can('update', App\Models\Admin\MinisterioModel::class)
											<x-button class="icon-background edit" :data-href="route('admin.paginas.ministerios.edit', $post->id)"> edit </x-button>
										@endcan
									</div>
								@endcan

								<img src="{{ route('home.ministerios.show-image', $post->id) . '?action=preview' }}" height="210">
							</div>

							<div class="card-content center-align gradient-0deg-grey-grey">
								<h5 class="card-title bold mb-6 mt-0">{{ $post->titulo }}</h5>
								<p class="grey-text text-darken-2">{{ $post->subtitulo }}</p>
							</div>

							<div class="card-reveal red darken-4 white-text">
								<div class="row">
									<div class="col s12">
										Tem certeza que deseja remover este ministerio?
									</div>
								</div>
								<br>
								<br>
								<div class="row">
									<div class="col s6 left-align">
										<button class="btn card-title white black-text waves-effect" style="font-size: inherit; font-family: inherit;">Não</button>
									</div>
									<form action="{{ route('admin.paginas.ministerios.delete') }}" method="post">
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
					Nenhum ministerio cadastrado.
				</div>
			</div>
		@endif

		{{-- @if (isset($ministerios) && $ministerios->count() > 0)
			<div class="row">
				@foreach ($ministerios as $ministerio)
					<div class="col s6 m3 l3 mb-3">
						<div class="avatar card transparent z-depth-0 no-padding">

							@if (!$ministerio->status)
								<i class="inactive material-symbols-outlined"> visibility_off </i>
							@endif

							<div class="card-image">
								<div class="circle light-green-border border-lighten-4 border-10">
									<img src="{{ route('home.ministerios.show-image', $ministerio->id) . '?action=preview' }}">
									<div class="btn-group">
										<x-button class="btn activator btn-floating delete material-symbols-outlined font-weight-400">delete</x-button>
										<x-button class="icon-background btn btn-floating edit material-symbols-outlined font-weight-400" :data-href="route('admin.paginas.ministerios.edit', $ministerio->id)"> edit </x-button>
									</div>
								</div>
							</div>

							<div class="card-content no-margin no-padding center-align black-text">
								<h5 class="white-text">{{ $ministerio->titulo }}</h5>
							</div>
							<div class="card-reveal red darken-4 white-text">
								<div class="row">
									<div class="col s12">
										Tem certeza que deseja remover este ministerio?
									</div>
								</div>
								<br>
								<br>
								<div class="row">
									<div class="col s6 left-align">
										<button class="btn card-title white black-text waves-effect" style="font-size: inherit; font-family: inherit;">Não</button>
									</div>
									<form action="{{ route('admin.paginas.ministerios.delete') }}" method="post">
										@csrf
										<input type="hidden" name="_method" value="delete">
										<input type="hidden" name="id" value="{{ $ministerio->id }}">
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
					Nenhum ministerio cadastrado.
				</div>
			</div>
		@endif --}}

		@include('admin.paginas.ministerios.includes.form')

	</x-slot:body>

	@pushOnce('scripts')
		<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>
	@endPushOnce

</x-admin-layout>
