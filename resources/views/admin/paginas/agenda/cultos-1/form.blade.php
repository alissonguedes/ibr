@php
	if (request('id')):
	    $id = $row->id;
	    $titulo = $row->evento;
	    $subtitulo = $row->subtitulo;
	    $descricao = $row->descricao;

	    $data_ini = date('d/m/Y', strtotime($row->data_ini));
	    $data_fim = date('d/m/Y', strtotime($row->data_fim));
	    $data_evento = $data_ini . ' - ' . $data_fim;

	    $data_inscricao_ini = date('d/m/Y', strtotime($row->data_inscricao_ini));
	    $data_inscricao_fim = date('d/m/Y', strtotime($row->data_inscricao_fim));
	    $data_inscricao = $data_inscricao_ini . ' - ' . $data_inscricao_fim;

	    $local = $row->local_evento;
	    $endereco = $row->endereco;
	    $video = $row->video;
	    $url = $row->url;

	    $inscricao_encerrada = $row->inscricao_encerrada;
	    $url = $row->url;
	    $status = $row->status;
	    $imagem = route('home.apresentacao.show-image', $id) . '?action=preview';
	endif;
@endphp

<x-header-page data-href="{{ route('admin.paginas.agenda.index') }}" placeholder="Pesquisar eventos..." title="Adicionar Evento">
	@can('create', App\Models\Admin\AgendaModel::class)
		<x-slot:add_button>add</x-slot:add_button>
	@endcan
</x-header-page>

<x-slot:form action="{{ route('admin.paginas.agenda.cultos.post') }}" method="post" class="card-reveal no-padding" style="{{ $errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}" enctype="multipart/form-data" autocomplete="off">

	<div class="card card-panel no-border no-margin no-padding">

		<div class="card-content">

			@csrf

			<input type="hidden" name="categoria" value="agenda">
			<input type="hidden" name="tipo" value="A">
			<input type="hidden" name="subtipo" value="culto">

			@if (request('id'))
				<input type="hidden" name="_method" value="put">
				<input type="hidden" name="id" value="{{ $id }}">
			@endif

			<div class="col row">

				<div class="col s12">

					<div class="row">
						<div class="col s12">
							<h5 class="form-title">
								<i class="material-symbols-outlined left">event</i>
								Informações do culto
							</h5>
						</div>
					</div>

					<!-- BEGIN título -->
					<div class="row">
						<div class="col s12 l6">
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

					<!-- BEGIN Data -->
					<div class="row">
						<div class="col s12 l6">
							<div class="input-field mb-2 @error('data') error @enderror">
								<label for="data">Data do evento</label>
								<x-text-input type="text" name="data" id="data" class="daterange" :value="old('data', $data_evento ?? null)" />
								@error('data')
									<small class="error">{{ $message }}</small>
								@enderror
							</div>
						</div>
					</div>
					<!-- END Data -->

					<style>
						label.btn {
							margin: 30px 0;
						}

						label.btn .material-symbols-outlined {
							font-size: 28px;
						}

						label.btn .material-symbols-outlined,
						label.btn span {
							cursor: pointer;
							line-height: normal;
						}

						label.btn span {
							display: block;
						}

						label.btn .material-symbols-outlined~input[type="checkbox"],
						label.btn .material-symbols-outlined~input[type="radio"] {
							display: block !important;
							cursor: pointer;
						}

						label.btn input[type="checkbox"]:checked~.material-symbols-outlined,
						label.btn input[type="radio"]:checked~.material-symbols-outlined,
						label.btn input[type="radio"]:checked~span {
							color: var(--light-green) !important;
						}
					</style>

					{{--



					<!-- BEGIN descrição -->
					<div class="row">
						<div class="col s12">
							<div class="input-field mb-2">
								<textarea type="text" name="descricao" id="descricao" class="editor">{{ old('descricao', $descricao ?? null) }}</textarea>
							</div>
						</div>
					</div>
					<!-- END descrição -->

					<div class="divider mt-3 mb-3 grey darken-4"></div>

					<div class="row">
						<div class="col s12">
							<h5 class="form-title">
								<i class="material-symbols-outlined left">event</i>
								Inscrições
							</h5>
						</div>
					</div>

					<!-- BEGIN Data -->
					<div class="row">
						<div class="col s6">
							<div class="input-field mb-2 @error('data_inscricao') error @enderror">
								<label for="data">Início e fim das inscrições</label>
								<x-text-input type="text" name="data_inscricao" id="data_inscricao" class="daterange" :value="old('data_inscricao', $data_inscricao ?? null)" />
								@error('data_inscricao')
									<small class="error">{{ $message }}</small>
								@enderror
							</div>
						</div>
					</div>
					<!-- END Data -->

					<!-- BEGIN inscrições encerradas -->
					<div class="row">
						<div class="col s12">
							<div class="input-field">
								<label for="inscricao_encerrada" class="">Inscrições encerradas</label>
								<div class="switch">
									<label>
										Não
										<input type="checkbox" name="inscricao_encerrada" id="inscricao_encerrada" value="1" @checked(old() ? old('inscricao_encerrada') : (isset($inscricao_encerrada) ? $inscricao_encerrada : false))>
										<span class="lever"></span>
										Sim
									</label>
								</div>
							</div>
						</div>
					</div>
					<!-- END inscrições encerradas -->

					<div class="divider mt-3 mb-3 grey darken-4"></div>

					<div class="row">
						<div class="col s12">
							<h5 class="form-title">
								<i class="material-symbols-outlined left">location_on</i>
								Localização
							</h5>
						</div>
					</div>

					<!-- BEGIN local -->
					<div class="row">
						<div class="col s12">
							<div class="input-field mb-2 @error('local') error @enderror">
								<label for="local">Local do evento</label>
								<x-text-input type="text" name="local" id="local" :value="old('local', $local ?? null)" />
								@error('local')
									<small class="error">{{ $message }}</small>
								@enderror
							</div>
						</div>
					</div>
					<!-- END local -->

					<!-- BEGIN local -->
					<div class="row">
						<div class="col s12">
							<div class="input-field mb-2 @error('endereco') error @enderror">
								<label for="local">Endereço</label>
								<x-text-input type="text" name="endereco" id="endereco" :value="old('endereco', $endereco ?? null)" />
								@error('endereco')
									<small class="error">{{ $message }}</small>
								@enderror
							</div>
						</div>
					</div>
					<!-- END local -->

					<div class="divider mt-3 mb-3 grey darken-4"></div>

					<div class="row">
						<div class="col s12">
							<h5 class="form-title">
								<i class="material-symbols-outlined left">media_link</i>
								Mídias
							</h5>
						</div>
					</div>

					<!-- BEGIN Link -->
					<div class="row">
						<div class="col s12">
							<div class="input-field mb-2 @error('url') error @enderror">
								<label for="url">Vídeo do evento</label>
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

					<!-- BEGIN ImageView -->
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
					<!-- END ImageView -->

					<div class="divider mt-3 mb-3 grey darken-4"></div>

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
					<!-- END status --> --}}

				</div>
			</div>

		</div>

		<div class="card-action right-align">
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

	</div>

</x-slot:form>
