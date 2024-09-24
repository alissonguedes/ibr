@php
	if (isset($post)) {
	    $id = $post->id;
	    $titulo = $post->titulo;
	    $subtitulo = $post->subtitulo;
	    $conteudo = $post->conteudo;
	    $file = new App\Models\Admin\FileModel();
	    $status = $post->status;
		$url = $post->url;
		$texto_url = $post->texto_url;
	    $imagem = route('home.propositos.show-image', $id) . '?action=preview';
	}
@endphp

<form action="{{ route('admin.paginas.home.propositos.post') }}" method="post" class="card card-panel animated fadeIn" style="display: block; transform: translateY(0%);" enctype="multipart/form-data" autocomplete="off">

	@csrf

	{{-- <input type="hidden" name="titulo_slug" value="proposito"> --}}
	<input type="hidden" name="categoria" value="proposito">
	<input type="hidden" name="tipo" value="post">

	@if (isset($id))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	<div class="card-content padding-2" style="">

		<div class="col row">

			<div class="col s12">

				<!-- BEGIN título -->
				<div class="row">
					<div class="col s12">
						<div class="input-field @error('titulo') error @enderror">
							<label id="titulo">Título</label>
							<x-text-input type="text" name="titulo" id="titulo" :value="old('titulo', $titulo ?? null)" autofocus="autofocus" maxlength="250" />
							@error('titulo')
								<small class="error">{{ $message }}</small>
							@enderror
						</div>
					</div>
				</div>
				<!-- END título -->

				{{-- <!-- BEGIN descrição -->
				<div class="row">
					<div class="col s12">
						<div class="input-field @error('subtitulo') error @enderror">
							<label for="subtitulo">Subtítulo</label>
							<x-text-input type="text" name="subtitulo" id="subtitulo" :value="old('subtitulo', $subtitulo ?? null)" />
							@error('subtitulo')
								<small class="error">{{ $message }}</small>
							@enderror
						</div>
					</div>
				</div>
				<!-- END descrição --> --}}

				<!-- BEGIN Texto -->
				<div class="row">
					<div class="col s12">
						<div class="input-field @error('conteudo') error @enderror">
							{{-- <label for="texto">Texto</label> --}}
							<textarea type="text" name="conteudo" id="conteudo" class="editor" rows="300">{{ old('conteudo', $conteudo ?? null) }}</textarea>
							@error('conteudo')
								<small class="error">{{ $message }}</small>
							@enderror
						</div>
					</div>
				</div>
				<!-- END Texto -->

			<!-- BEGIN Link -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2 @error('url') error @enderror">
						<label for="url">Link</label>
						<x-text-input type="url" name="url" id="url" :value="old('url', $url ?? null)" />
						@error('url')
							<small class="error">{{ $message }}</small>
						@enderror
					</div>
				</div>
			</div>
			<!-- END Link -->

			<!-- BEGIN Link -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2 @error('texto_url') error @enderror">
						<label for="url">Texto do Link</label>
						<x-text-input type="text" name="texto_url" id="texto_url" :value="old('texto_url', $texto_url ?? null)" />
						@error('url')
							<small class="error">{{ $message }}</small>
						@enderror
					</div>
				</div>
			</div>
			<!-- END Link -->

				<!-- BEGIN imagem -->
				<div class="row">
					<div class="col s12">
						<div class="file-field input-field @error('imagem') error @enderror">
							<div class="btn">
								<span>File</span>
								<x-text-input type="file" name="imagem" />
							</div>
							<div class="file-path-wrapper">
								<x-text-input type="text" class="file-path validate" />
							</div>
							@error('imagem')
								<small class="error">{{ $message }}</small>
							@enderror
						</div>
					</div>
				</div>
				<!-- END imagem -->

				<!-- BEGIN imgShow -->
				<div class="row">
					<div class="col s12">
						@if (isset($imagem))
							<div class="row">
								<div class="col s12">
									<img src="{{ $imagem }}" class="responsive-img materialboxed" alt="">
								</div>
							</div>
						@endif
						<div class="row">
							<div class="col s12">
								<small>A imagem deve ter no máximo 1920x1080</small>
							</div>
						</div>
					</div>
				</div>
				<!-- END imgShow -->

				<!-- BEGIN status -->
				<div class="row">
					<div class="col s12">
						<div class="input-field">
							<label for="status" class="">Ativo</label>
							<div class="switch">
								<label>
									Não
									<input type="checkbox" name="status" id="status" value="1" @checked(old() ? old('status') : (isset($status) ? $status : true))>
									<span class="lever"></span>
									Sim
								</label>
							</div>
						</div>
					</div>
				</div>
				<!-- END status -->

			</div>

		</div>

	</div>

	<div class="card-action">
		<div class="row">
			<div class="col s12 right-align">
				<button type="reset" class="btn waves-effect">
					<i class="material-symbols-outlined left">cancel</i>
					<span>Cancelar</span>
				</button>
				<button type="submit" class="btn waves-effect">
					<i class="material-symbols-outlined left">save</i>
					<span>Salvar</span>
				</button>
			</div>
		</div>
	</div>

</form>
