@if (request('id'))
	@php
		$id = $row->id;
		$titulo = $row->titulo;
		$descricao = $row->descricao;
		$url = $row->url;
		$imagem = route('admin.home.nossa-crenca.show-image', $id) . '?action=preview';
	@endphp
@endif

<form action="{{ route('admin.home.nossa-crenca.post') }}" method="post" class="card" style="display: block; transform: translateY(0%);" autocomplete="off">
	@csrf

	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	<div class="card-content padding-2 scroller" style="height: calc(100% - 70px)">

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

				<!-- BEGIN descrição -->
				<div class="row">
					<div class="col s12">
						<div class="input-field @error('titulo') error @enderror">
							<label for="descricao">Descrição</label>
							<x-text-input type="text" name="descricao" id="descricao" :value="old('descricao', $descricao ?? null)" />
							@error('descricao')
								<small class="error">{{ $message }}</small>
							@enderror
						</div>
					</div>
				</div>
				<!-- END descrição -->

				<!-- BEGIN Texto -->
				<div class="row">
					<div class="col s12">
						<div class="input-field @error('texto') error @enderror">
							{{-- <label for="texto">Texto</label> --}}
							<textarea type="text" name="texto" id="texto" class="editor" rows="300">{{ old('texto', $texto ?? null) }}</textarea>
							@error('texto')
								<small class="error">{{ $message }}</small>
							@enderror
						</div>
					</div>
				</div>
				<!-- END Texto -->

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
				<!-- END imgShow -->

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

{{-- <x-slot:scripts_form>
	<script src="{{ asset('assets/js/clinica/js/pacientes/form.js') }}" defer></script>
</x-slot:scripts_form> --}}
