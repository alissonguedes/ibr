<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.paginas.a-ibr.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> A IBR </x-slot:title>

	<x-slot:body>

		@if (isset($posts) && $posts->count() > 0)

			@foreach ($posts as $i => $post)
				@php
					$file = new App\Models\Admin\FileModel();
					$hasFile = $file->fileExists($post->id, 'post');
				@endphp

				<div class="row">

					<div class="col s12">

						<div class="card white @if ($i % 2 != 0) reverse @endif">
							@if (!$post->status)
								<i class="inactive material-symbols-outlined"> visibility_off </i>
							@endif
							<div class="card-content black-text">

								@canany(['update', 'delete'], App\Models\Admin\PostModel::class)
									<div class="btn-group">
										@can('delete', App\Models\Admin\PostModel::class)
											<x-button class="btn activator btn-floating delete material-symbols-outlined font-weight-400">delete</x-button>
										@endcan
										@can('update', App\Models\Admin\PostModel::class)
											<x-button class="icon-background btn btn-floating edit material-symbols-outlined font-weight-400" :data-href="route('admin.paginas.a-ibr.edit', $post->id)"> edit </x-button>
										@endcan
									</div>
								@endcan

								<div class="titulo">
									<h6 class="bold" style="">{{ $post->subtitulo }}</h6>
									<h4 class="bold no-margin" style="">{{ $post->titulo }}</h4>
								</div>
								<div class="flex flex-auto flex-center flex-end mt-3">
									@if ($hasFile)
										<div class="card-image right">
											<div class="circle no-margin">
												<img src="{{ route('home.a-ibr.show-image', $post->id) . '?action=preview' }}" height="210">
											</div>
										</div>
									@endif
									<span class="">{!! $post->conteudo !!}</span>
								</div>
							</div>

							<div class="card-reveal red darken-4 white-text">
								<div class="row">
									<div class="col s12">
										Tem certeza que deseja remover este banner?
									</div>
								</div>
								<br>
								<br>
								<div class="row">
									<div class="col s6 left-align">
										<button class="btn card-title white black-text waves-effect" style="font-size: inherit; font-family: inherit;">Não</button>
									</div>
									<form action="{{ route('admin.paginas.a-ibr.delete') }}" method="post">
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

				</div>
			@endforeach
		@else
			<div class="row">
				<div class="col s12">
					<p>Nenhum registro encontrado</p>
				</div>
			</div>

		@endif

	</x-slot:body>

	@include('admin.paginas.a-ibr.includes.form')

	@pushOnce('scripts')
		<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>
	@endPushOnce

</x-admin-layout>
