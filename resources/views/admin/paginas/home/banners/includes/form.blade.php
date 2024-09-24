<x-header-page data-href="{{ route('admin.paginas.home.banners.index') }}" placeholder="Pesquisar banners..." title="Adicionar Banner">

	@can('create', App\Models\Admin\BannerModel::class)
		<x-slot:add_button>add</x-slot:add_button>
	@endcan

</x-header-page>

@php
	if (request('id')):
	    $tipo = $row->tipo;
	    $categoria = $row->categoria;
	    $id = $row->id;
	    $titulo = $row->titulo;
	    $titulo_slug = $row->titulo_slug;
	    $descricao = $row->descricao;
	    $url = $row->url;
	    $status = $row->status;
	    $imagem = route('home.banners.show-image', $id) . '?action=preview';
	endif;
@endphp

<x-slot:form action="{{ route('admin.paginas.home.banners.post') }}" method="post" style="{{ $errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}" autocomplete="off">

	@csrf

	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	<input type="hidden" name="categoria" value="banner">
	<input type="hidden" name="tipo" value="post">

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

			<!-- BEGIN título -->
			@can('edit_rotulo', App\Models\Admin\BannerModel::class)
				<div class="row">
					<div class="col s12">
						<div class="input-field amber-text mb-2 @error('titulo') error @enderror">
							<label for="titulo_slug">Rótulo do campo</label>
							<x-text-input type="text" name="titulo_slug" id="titulo_slug" :value="old('titulo_slug', $titulo_slug ?? null)" />
							@error('titulo')
								<small class="error">{{ $message }}</small>
							@enderror
						</div>
					</div>
				</div>
			@else
				{{-- <label for="titulo_slug" class="grey-text text-darken-2">Rótulo do campo</label> --}}
				{{-- <div class="input-label disabled grey-text text-lighten-1" style="color: var(--grey-darken-1) !important">{{ $titulo_slug ?? null }}</div> --}}
				<input type="hidden" name="titulo_slug" value="{{ $titulo_slug ?? null }}">
			@endcan
			<!-- END título -->

			<!-- BEGIN descrição -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2">
						<label for="descricao">Descrição</label>
						<x-text-input type="text" name="descricao" id="descricao" :value="old('descricao', $descricao ?? null)" />
					</div>
				</div>
			</div>
			<!-- END descrição -->

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

{{-- <x-slot:scripts_form>
	<script src="{{ asset('assets/js/clinica/js/pacientes/form.js') }}" defer></script>
</x-slot:scripts_form> --}}
