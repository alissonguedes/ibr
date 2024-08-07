<x-header-page data-href="{{ route('admin.paginas.ministerios.index') }}" placeholder="Pesquisar postagem..." title="Adicionar Postagem">
	@can('create', App\Models\Admin\MinisterioModel::class)
		<x-slot:add_button>add</x-slot:add_button>
	@endcan
</x-header-page>

@php
	if (request('id') && !empty($row)):
	    $id = $row->id;
	    $titulo = $row->titulo;
	    $subtitulo = $row->subtitulo;
	    $conteudo = $row->conteudo;
	    $url = $row->url;
	    $status = $row->status;
	    $imagem = route('home.ministerios.show-image', $id) . '?action=preview';
	endif;
@endphp

<x-slot:form action="{{ route('admin.paginas.ministerios.post') }}" method="post" style="{{ $errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}" autocomplete="off">

	@csrf

	<input type="hidden" name="categoria" value="ministerio">
	<input type="hidden" name="tipo" value="post">

	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	<div class="col row">

		<div class="col s12 l3">
			<div class="row">
				<div class="col s12">
					@if (request('id'))
						<img src="{{ $imagem ?? asset('assets/img/slides/img2.jpg') }}" class="responsive-img materialboxed" alt="">
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<small>A imagem deve ter no máximo 1920x1080</small>
				</div>
			</div>
		</div>
		<div class="col s12 l9">

			<!-- BEGIN título -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2 @error('titulo') error @enderror">
						<label for="titulo">Título</label>
						<x-text-input type="text" name="titulo" id="titulo" :value="old('titulo', $titulo ?? null)" autofocus="autofocus" />
						@error('titulo')
							<small class="error">{{ $message }}</small>
						@enderror
					</div>
				</div>
			</div>
			<!-- END título -->

			<!-- BEGIN descrição -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2">
						<label for="subtitulo">Subtítulo</label>
						<x-text-input type="text" name="subtitulo" id="subtitulo" :value="old('subtitulo', $subtitulo ?? null)" />
					</div>
				</div>
			</div>
			<!-- END descrição -->

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

	<x-slot:card_footer>
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
	</x-slot:card_footer>

</x-slot:form>
