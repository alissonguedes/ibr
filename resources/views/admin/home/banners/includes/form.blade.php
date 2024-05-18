<x-header-page data-url="{{ route('admin.home.banners.index') }}" placeholder="Pesquisar banners..." title="Adicionar Banner">add</x-header-page>

@if (request('id'))
	@php
	@endphp
@endif

<x-slot:form action="{{ route('admin.home.banners.post') }}" method="post" style="{{ $errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}">

	@csrf

	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" :value="{{ $id }}">
	@endif

	{{-- <x-slot:form_tabs>
		<ul class="tabs tabs-fixed-width">
			<li class="tab"><a href="#dados-pessoais" class="active">Dados Pessoais</a></li>
			<li class="tab"><a href="#contato">Contato</a></li>
			<li class="tab"><a href="#endereco">Endereço</a></li>
			<li class="tab"><a href="#convenio">Convênio</a></li>
			<li class="tab"><a href="#observacoes">Observações</a></li>
			<li class="tab"><a href="#outras_informacoes">Outras informações</a></li>
		</ul>
	</x-slot:form_tabs> --}}

	<div class="col row">

		<div class="col s3">
			<div class="row">
				<div class="col s12">
					<img src="{{ asset('assets/img/slides/img1.jpg') }}" class="responsive-img" alt="">
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<small>A imagem deve ter no máximo 1920x1080</small>
				</div>
			</div>
		</div>
		<div class="col s9">

			<!-- BEGIN título -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2 @error('titulo') error @enderror">
						<label id="titulo">Título</label>
						<x-text-input type="text" name="titulo" id="titulo" :value="old('titulo', $row->titulo ?? null)" autofocus="autofocus" />
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
						<label for="descricao">Descrição</label>
						<x-text-input type="text" name="descricao" id="descricao" :value="old('descricao', $row->descricao ?? null)" />
					</div>
				</div>
			</div>
			<!-- END descrição -->

			<!-- BEGIN Link -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2 @error('url') error @enderror">
						<label for="url">Link</label>
						<x-text-input type="text" name="url" id="url" :value="old('url', $row->url ?? null)" />
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

				{{-- <div class="input-field media conj_img_edit">
					<div class="img_icon_pdf image_view z-depth-4 material-icons">
						@if (isset($row) && $row->imagem)
						<img src="$row->imagem " class="img_cem materialboxed original">
						<x-text-input type="hidden" name="original_name">
						 @endif;
					</div>
					<div class="nome_arquivo" data-placeholder="isset($row) && $row->imagem ? basename($row->imagem) : 'Selecione uma imagem' "></div>
					<div class="bt_excluir waves-effect redefinir amber" style="isset($row) && !empty($row->imagem) ? 'display: none;' : '' ">
						<i class="material-icons">undo</i>
					</div>
					<div class="btn_add_new_image waves-effect image_alt amber">
						<i class="material-icons">add_photo_alternate</i>
					</div>
					<x-text-input type="file" name="imagem" id="img_perfil" accept="image">
				</div> --}}

			</div>
			<!-- END imagem -->

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
