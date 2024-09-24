<x-header-page data-href="{{ route('admin.paginas.cultos.index') }}" placeholder="Pesquisar cultos..." title="Adicionar Culto">
	@can('create', App\Models\Admin\CultoModel::class)
		<x-slot:add_button>add</x-slot:add_button>
	@endcan
</x-header-page>

@php
	if (request('id')):
	    $id = $row->id;
	    $titulo = $row->titulo;
	    $subtitulo = $row->subtitulo;
	    $conteudo = $row->conteudo;
	    $data = date('d/m/Y', strtotime($row->data));
	    $data_evento = $row->data_evento;
	    $url = $row->url;
	    $status = $row->status;
	    $imagem = route('home.posts.show-image', $id) . '?action=preview';
	endif;
@endphp

<x-slot:form action="{{ route('admin.paginas.cultos.post') }}" method="post" style="{{ $errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}" autocomplete="off" novalidate>

	@csrf

	{{-- <input type="hidden" name="tipo" value="post">
	<input type="hidden" name="titulo_slug" value="cultos"> --}}

	<input type="hidden" name="categoria" value="culto">
	<input type="hidden" name="tipo" value="post">

	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	<div class="col row">

		<div class="col s12">

			<!-- BEGIN título -->
			<div class="row">
				<div class="col s12">
					<div class="input-field mb-2 @error('titulo') error @enderror">
						<label id="titulo">Título</label>
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
					<div class="input-field mb-2">
						<label for="subtitulo">Pastor</label>
						<x-text-input type="text" name="subtitulo" id="subtitulo" :value="old('subtitulo', $subtitulo ?? null)" />
					</div>
				</div>
			</div>
			<!-- END descrição -->

			<!-- BEGIN Data -->
			<div class="row">
				<div class="col s12">
					<div class="input-field mb-2 @error('data') error @enderror">
						<label for="data">Data do culto</label>
						<x-text-input type="text" name="data" id="data" class="datepicker" :value="old('data', $data ?? null)" />
						@error('data')
							<small class="error">{{ $message }}</small>
						@enderror
					</div>
				</div>
			</div>
			<!-- END Data -->

			<!-- BEGIN Link -->
			<div class="row">
				<div class="col s12">
					<div class="input-field mb-2 @error('url') error @enderror">
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
							<span>Imagem da Capa</span>
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

			{{-- <!-- BEGIN ImageView -->
			<div class="row">
				<div class="col s12">
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
			</div>
			<!-- END ImageView --> --}}

			<!-- BEGIN descrição -->
			<div class="row">
				<div class="col s12">
					<div class="input-field mb-2">
						{{-- <label for="conteudo">Conteúdo</label> --}}
						<textarea type="text" name="conteudo" id="conteudo" class="editor">{{ old('conteudo', $conteudo ?? null) }}</textarea>
					</div>
				</div>
			</div>
			<!-- END descrição -->

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

	<style>
		.datepicker-date-display {
			background-color: var(--grey-darken-4);
		}

		.datepicker-calendar-container {
			background-color: var(--grey-darken-5);
		}
	</style>

</x-slot:form>

{{-- <x-slot:scripts_form>
	<script src="{{ asset('assets/js/clinica/js/pacientes/form.js') }}" defer></script>
</x-slot:scripts_form> --}}
