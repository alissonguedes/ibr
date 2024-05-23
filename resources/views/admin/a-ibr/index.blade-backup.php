<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.a-ibr.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> A IBR </x-slot:title>

	<x-slot:body>

		@if (isset($posts) && $posts->count() > 0)
			@foreach ($posts as $post)
				<div class="row">
					<div class="col s12 m6 l12">
						<div class="card horizontal grey darken-4">

							@php
								$file = new App\Models\Admin\FileModel();
								$hasFile = $file->fileExists($post->id, 'post');
							@endphp

							{{-- <div class="card-image"> --}}
								@if ($hasFile)
									@if (!$post->status)
										<i class="status material-symbols-outlined"> visibility_off </i>
									@endif
									<img src="{{ route('home.a-ibr.show-image', $post->id) . '?action=preview' }}" height="210">
								@endif
								<div class="delete activator material-symbols-outlined font-weight-400">delete</div>
							{{-- </div> --}}

							{{-- <div class="btn-group">

							</div> --}}

							<div class="card-stacked" style="min-height: 200px;">
								<div class="card-content pt-0">
									<h3 class="white-text" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 90%; position: relative;">{{ strip_tags(substr(replace($post->titulo, ' ', false), 0, 100)) }}</h3>
									<h5 class="white-text" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 90%; position: relative;">{{ strip_tags(substr($post->subtitulo, 0, 100)) }}</h5>
								</div>
								<div class="card-action">
									<div class="row">
										<div class="col s9">
											<p style="padding: 0px 10px; line-height: 32px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 90%; position: relative;">{!! substr(strip_tags($post->conteudo), 0, 100) !!}</p>
										</div>
										<div class="col s3 right-align">
											<x-button class="icon-background gradient-45deg-green-light-green black-text btn-small" :data-href="route('admin.a-ibr.edit', $post->id)"> edit </x-button>
										</div>
									</div>
								</div>
							</div>

							<div class="card-reveal red darken-4 white-text">
								<div class="row">
									<div class="col s12">
										Tem certeza que deseja remover esta postagem?
									</div>
								</div>
								<br>
								<br>
								<div class="row">
									<div class="col s6 left-align">
										<button class="btn card-title white black-text waves-effect" style="font-size: inherit; font-family: inherit;">Não</button>
									</div>
									<form action="{{ route('admin.a-ibr.delete') }}" method="post">
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
					Nenhuma postagem cadastrada.
				</div>
			</div>
		@endif

	</x-slot:body>

	@include('admin.a-ibr.includes.form')

	<x-slot:script>
	</x-slot:script>

</x-admin-layout>
