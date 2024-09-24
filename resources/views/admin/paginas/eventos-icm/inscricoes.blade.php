<x-app-layout>

	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			<a href="{{ route('admin.eventos.index') }}" class="material-symbols-outlined waves-effect btn btn-floating white black-text" style="font-size: 24px;"> arrow_back
			</a>
			<span class="" style="display: inline-block; margin-left: 10px;">
				{{ __('Lista dos inscritos no evento: ' . $evento->evento . ', ' . $evento->data_ini) }}
			</span>
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100">

					@if (isset($inscritos))

						<div class="row">
							<div class="col s6">Total de inscritos: {{ $inscritos->count() }}</div>
							<div class="col s6 right-align" style="display: flex; flex-direction: row; place-content: end;">
								{{-- <a href="{{ route('admin.eventos.inscritos.download', [request('id'), 'pdf']) }}"
									class="btn white black-text waves-effect"
									style="display: flex; place-content: center; align-items: center; margin-left: 10px;">
									<span class="material-symbols-outlined" style="margin-right: 5px;">download</span> PDF
								</a> --}}
								<a href="{{ route('admin.eventos.inscritos.download', [request('id'), 'xls']) }}" class="btn white black-text waves-effect" style="display: flex; place-content: center; align-items: center; margin-left: 10px;">
									<span class="material-symbols-outlined" style="margin-right: 5px;">download</span> XLS
								</a>
							</div>
						</div>

						<table id="myTable" class="display">
							<thead>
								<tr>
									<th>Membro</th>
									<th>Função</th>
									<th>Igreja</th>
									{{-- <th>Evento</th> --}}
									<th>Transporte</th>
									<th>Data da inscrição</th>
									<th data-orderable="false" width="1%"></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($inscritos as $e)
									@php
										$cidade = App\Models\PaisModel::select('cidade')
										    ->from('tb_cidade')
										    ->where('id', $e->cidade)
										    ->first();
										$estado = App\Models\PaisModel::select('estado')
										    ->from('tb_estado')
										    ->where('id', $e->uf)
										    ->first();
										$funcao = App\Models\Ebd\FuncaoModel::select('descricao')
										    ->where('id', $e->funcao)
										    ->first();
										$igreja = App\Models\Ebd\IgrejaModel::select('nome')
										    ->where('id', $e->igreja)
										    ->first();
									@endphp
									<tr>
										<td>{{ $e->membro }}</td>
										<td style="text-transform: uppercase;">{{ $funcao->descricao }}</td>
										<td style="text-transform: uppercase;">{{ $igreja->nome }}</td>
										{{-- <td>{{ $e->evento }}</td> --}}
										<td>{{ $e->tipo_transporte == 'onibus' ? 'Ônibus' : $e->tipo_transporte }}</td>
										<td>{{ $e->data_inscricao }}</td>
										<td>
											{{-- <a href="{{ route('admin.inscritos.details', $e->id) }}">Inscritos</a>
											<a href="{{ route('admin.inscritos.edit', $e->id) }}">Editar</a> --}}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						Nenhum inscrito cadastrado.
					@endif

				</div>
			</div>
		</div>
	</div>

	{{-- <x-slot name="modal_form">
		<form action="{{ route('admin.inscritos.save') }}" method="post">
			@csrf
			@if (request('id'))
				<input type="hidden" name="id" value={{ $inscrito->id }}>
			@endif
			<div class="row">
				<div class="col s12 l6">
					<div id="modal-form" class="modal modal-fixed-footer">
						<div class="modal-content">

							<div class="input-field">
								<label for="categoria" class="active">Tipo do inscrito</label>
								<select name="categoria" id="categoria">
									<option value="" selected>Informe o tipo do inscrito</option>
									@isset($categorias)
										@foreach ($categorias as $categoria)
											<option value="{{ $categoria->id }}" @selected(isset($inscrito) && $inscrito->id_igreja === $categoria->id)>{{ $categoria->descricao }}</option>
										@endforeach
									@endisset
								</select>
							</div>

							<div class="row">
								<div class="col s6">
									<div class="input-field">
										<label for="data_ini">Data de início</label>
										<input type="text" name="data_ini" id="data_ini" value="{{ $inscrito->data_ini ?? null }}">
									</div>
								</div>
								<div class="col s6">
									<div class="input-field">
										<label for="data_fim">Data de término</label>
										<input type="text" name="data_fim" id="data_fim" value="{{ $inscrito->data_fim ?? null }}">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col s6">
									<div class="input-field">
										<label for="data_inscricao_ini">Início das inscrições</label>
										<input type="text" name="data_inscricao_ini" id="data_inscricao_ini" value="{{ $inscrito->data_inscricao_ini ?? null }}">
									</div>
								</div>
								<div class="col s6">
									<div class="input-field">
										<label for="data_inscricao_fim">Fim das inscrições</label>
										<input type="text" name="data_inscricao_fim" id="data_inscricao_fim" value="{{ $inscrito->data_inscricao_fim ?? null }}">
									</div>
								</div>
							</div>

							<div class="input-field">
								<label for="local">Local</label>
								<input type="text" name="local" id="local" value="{{ $inscrito->titulo ?? null }}">
							</div>

							<div class="input-field">
								<label for="inscrito">Nome do inscrito</label>
								<input type="text" name="inscrito" id="inscrito" value="{{ $inscrito->titulo ?? null }}">
							</div>

							<div class="input-field">
								<label for="descricao">Descrição do inscrito</label>
								<textarea name="descricao" id="descricao" class="materialize-textarea">{{ $inscrito->descricao ?? null }}</textarea>
							</div>

							<div class="input-field">
								<label for="endereco">Endereço</label>
								<input type="text" name="endereco" id="endereco" value="{{ $inscrito->endereco ?? null }}">
							</div>

							<div class="input-field">
								<label for="observacao">Outras observações sobre o inscrito</label>
								<textarea name="observacao" id="observacao" class="materialize-textarea">{{ $inscrito->observacao ?? null }}</textarea>
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
	</x-slot> --}}

</x-app-layout>
