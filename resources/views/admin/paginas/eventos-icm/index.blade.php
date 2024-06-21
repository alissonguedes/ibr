<x-admin-layout>

	<x-slot:body>

		<x-slot name="header">
			<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
				{{ __('Eventos') }}
			</h2>
			<button type="button" class="btn green right modal-trigger waves-effect" data-target="modal-form">Adicionar Evento</button>
		</x-slot>

		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
					<div class="p-6 text-gray-900 dark:text-gray-100">

						@if (isset($eventos))
							<table id="myTable" class="display">
								<thead>
									<tr>
										<th>Evento</th>
										<th>Local</th>
										<th>Tipo</th>
										<th>Data (de / até)</th>
										<th>Inscrições (de / até)</th>
										<th data-orderable="false" width="1%"></th>
									</tr>
								</thead>
								<tbody>
									@foreach ($eventos as $e)
										<tr>
											<td>{{ $e->evento }}</td>
											<td>{{ $e->local }}</td>
											<td>{{ $e->categoria }}</td>
											<td>{{ $e->data_ini }} - {{ $e->data_fim }}</td>
											<td>{{ $e->data_inscricao_ini }} - {{ $e->data_inscricao_fim }}</td>
											<td>
												<a href="{{ route('admin.eventos.details', $e->id) }}">Inscritos</a>
												@if (Auth::id() === 1)
													<a href="{{ route('admin.eventos.edit', $e->id) }}">Editar</a>
												@endif
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						@else
							Nenhum evento cadastrado.
						@endif

					</div>
				</div>
			</div>
		</div>

		<x-slot name="modal_form">
			<form action="{{ route('admin.paginas.eventos.post') }}" method="post">
				@csrf
				@if (request('id'))
					<input type="hidden" name="id" value={{ $evento->id }}>
				@endif
				<div class="row">
					<div class="col s12 l6">
						<div id="modal-form" class="modal modal-fixed-footer">
							<div class="modal-content">

								<div class="input-field">
									<label for="categoria" class="active">Tipo do evento</label>
									<select name="categoria" id="categoria">
										<option value="" selected>Informe o tipo do evento</option>
										@isset($categorias)
											@foreach ($categorias as $categoria)
												<option value="{{ $categoria->id }}" @selected(isset($evento) && $evento->id_igreja === $categoria->id)>{{ $categoria->descricao }}</option>
											@endforeach
										@endisset
									</select>
								</div>

								<div class="row">
									<div class="col s6">
										<div class="input-field">
											<label for="data_ini">Data de início</label>
											<input type="text" name="data_ini" id="data_ini" value="{{ $evento->data_ini ?? null }}">
										</div>
									</div>
									<div class="col s6">
										<div class="input-field">
											<label for="data_fim">Data de término</label>
											<input type="text" name="data_fim" id="data_fim" value="{{ $evento->data_fim ?? null }}">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col s6">
										<div class="input-field">
											<label for="data_inscricao_ini">Início das inscrições</label>
											<input type="text" name="data_inscricao_ini" id="data_inscricao_ini" value="{{ $evento->data_inscricao_ini ?? null }}">
										</div>
									</div>
									<div class="col s6">
										<div class="input-field">
											<label for="data_inscricao_fim">Fim das inscrições</label>
											<input type="text" name="data_inscricao_fim" id="data_inscricao_fim" value="{{ $evento->data_inscricao_fim ?? null }}">
										</div>
									</div>
								</div>

								<div class="input-field">
									<label for="local">Local</label>
									<input type="text" name="local" id="local" value="{{ $evento->titulo ?? null }}">
								</div>

								<div class="input-field">
									<label for="evento">Nome do evento</label>
									<input type="text" name="evento" id="evento" value="{{ $evento->titulo ?? null }}">
								</div>

								<div class="input-field">
									<label for="descricao">Descrição do evento</label>
									<textarea name="descricao" id="descricao" class="materialize-textarea">{{ $evento->descricao ?? null }}</textarea>
								</div>

								<div class="input-field">
									<label for="endereco">Endereço</label>
									<input type="text" name="endereco" id="endereco" value="{{ $evento->endereco ?? null }}">
								</div>

								<div class="input-field">
									<label for="observacao">Outras observações sobre o evento</label>
									<textarea name="observacao" id="observacao" class="materialize-textarea">{{ $evento->observacao ?? null }}</textarea>
								</div>

							</div>
							<div class="modal-footer">
								<button type="reset" class="btn white black-text modal-close mr-3">Cancelar</button>
								<button type="submit" class="btn">Salvar</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</x-slot>

	</x-slot:body>

</x-admin-layout>
