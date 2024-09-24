<x-header-page data-href="{{ route('admin.paginas.agenda.cultos.index') }}" placeholder="Pesquisar eventos..." title="Adicionar Evento">
	@can('create', App\Models\Admin\AgendaModel::class)
		<x-slot:add_button>add</x-slot:add_button>
	@endcan
</x-header-page>

@php
	if (request('id')):
	    $id = $row->id;
	    $titulo = $row->titulo;
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

<x-slot:form action="{{ route('admin.paginas.agenda.cultos.post') }}" method="post" style="{{ $errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}" enctype="multipart/form-data" autocomplete="off" novalidate>

	@csrf

	{{-- <input type="hidden" name="categoria" value="agenda"> --}}
	{{-- <input type="hidden" name="tipo" value="A"> --}}
	<input type="hidden" name="tipo" value="culto">

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
						<label id="titulo">Tema do culto</label>
						<x-text-input type="text" name="titulo" id="titulo" :value="old('titulo', $titulo ?? null)" autofocus="autofocus" />
						@error('titulo')
							<small class="error">{{ $message }}</small>
						@enderror
					</div>
				</div>
			</div>
			<!-- END título -->

			{{-- <!-- BEGIN Data -->
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
			<!-- END Data --> --}}

			<div class="row">
				<div class="col s12">
					<div class="input-field @error('horario') error @enderror">
						<div class="row">
							@error('horario')
								<div class="col s12 error">{{ $message }}</div>
							@enderror
						</div>
						<div class="row">

							<div class="col s12">
								{{-- @if (isset($dias_semana)) --}}

								@if (request('id'))
									@php
										$agenda_model = new App\Models\Admin\AgendaModel();
										$agenda_dados = $agenda_model->select('id', 'titulo', 'tipo', 'observacao', 'duracao', 'data', 'horarios', 'tempo_min_agendamento', 'tempo_max_agendamento', 'intervalo', 'max_agendamento', 'repetir', 'status')->from('tb_agenda')->where('id', request('id'))->get()->first();
									@endphp
								@endif

								@php
									$dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
									$horarios_agenda = [];
									$horarios = [];
								@endphp

								@foreach ($dias_semana as $key => $day)
									@php
										if (isset($agenda_dados)) {
										    $horarios = json_decode($agenda_dados->horarios, true);
										}
									@endphp
									<div class="row">
										<div class="col s12">
											<div class="day-range">
												<div class="dia-semana">
													<label class="bold white-text">{{ $day }}</label>
												</div>
												<div class="horario" data-day="{{ $key }}">

													@if (old('horario'))
														@php
															$dias = ['domingo' => 0, 'segunda' => 1, 'terca' => 2, 'quarta' => 3, 'quinta' => 4, 'sexta' => 5, 'sabado' => 6];
														@endphp

														@foreach (old('horario') as $dia => $horario)
															@php
																$d = $dias[$dia];
															@endphp

															@if ($d === $key)
																@php
																	$hora = array_combine($horario['inicio'], $horario['fim']);
																@endphp

																@if (count($hora) > 0)
																	@php
																		$i = 0;
																	@endphp
																	@foreach ($hora as $inicio => $fim)
																		@php
																			++$i;
																			$inicio = (preg_match('/^[0-9]{2}\:[0-9]{2}$/', $inicio) ? $inicio : $inicio . ':00') . ':00';
																			$fim = (preg_match('/^[0-9]{2}\:[0-9]{2}$/', $fim) ? $fim : $fim . ':00') . ':00';
																		@endphp
																		<div class="time-range">
																			<div class="input-field m-0 mb-1">
																				<input type="text" name="horario[{{ replace($day) }}][inicio][]" class="autocomplete timer browser-default" value="{{ date('H:i', strtotime($inicio)) }}" placeholder="hh:mm" autocomplete="off"> - <input type="text" name="horario[{{ replace($day) }}][fim][]" class="autocomplete timer browser-default" value="{{ date('H:i', strtotime($fim)) }}" placeholder="hh:mm" autocomplete="off">
																			</div>
																			<div class="acao">
																				<button type="button" class="btn btn-small btn-flat btn-floating transparent" data-trigger="delete_time">
																					<i class="material-symbols-outlined">block</i>
																				</button>
																				<button type="button" class="btn btn-small btn-flat btn-floating transparent @if ($i > 1) hide @endif" data-trigger="add_time">
																					<i class="material-symbols-outlined">add</i>
																				</button>
																			</div>
																		</div>
																	@endforeach
																@endif
															@endif
														@endforeach
													@elseif(!old('horario') && isset($horarios) && count($horarios) > 0)
														@if (isset($horarios[$key]))
															@foreach ($horarios[$key] as $i => $hora)
																<div class="time-range">
																	<div class="input-field m-0 mb-1">
																		<input type="text" name="horario[{{ replace($day) }}][inicio][]" class="autocomplete timer browser-default" value="{{ date('H:i', strtotime($hora['inicio'])) }}" placeholder="hh:mm" autocomplete="off"> - <input type="text" name="horario[{{ replace($day) }}][fim][]" class="autocomplete timer browser-default" value="{{ date('H:i', strtotime($hora['fim'])) }}" placeholder="hh:mm" autocomplete="off">
																		<div class="acao">
																			<button type="button" class="btn btn-small btn-flat btn-floating transparent" data-trigger="delete_time">
																				<i class="material-symbols-outlined">block</i>
																			</button>
																			<button type="button" class="btn btn-small btn-flat btn-floating transparent @if ($i > 0) hide @endif" data-trigger="add_time">
																				<i class="material-symbols-outlined">add</i>
																			</button>
																		</div>
																	</div>
																</div>
															@endforeach
														@endif
													@endif

													<div class="time-range disabled grey-text text-lighten-1 @if ((isset($horarios) && isset($horarios[$key])) || (old('horario') && array_key_exists(replace($day), old('horario')))) hide @endif">
														<div class="input-field m-0 mb-1">
															<div class="label">Indisponível</div>
														</div>
														<div class="acao">
															<button type="button" class="btn btn-small btn-flat btn-floating transparent" data-trigger="delete_time" disabled>
																<i class="material-symbols-outlined">block</i>
															</button>
															<button type="button" class="btn btn-small btn-flat btn-floating transparent" data-trigger="add_time">
																<i class="material-symbols-outlined">add</i>
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforeach
								{{-- @else
									<div class="row">
										<div class="col s12">
											<div class="day-range">
												<div class="dia-semana">
													<label class="strong black-text"></label>
												</div>
												<div class="horario" data-day="">
												</div>
											</div>
										</div>
									</div>
								@endif --}}
							</div>
						</div>
					</div>
				</div>
			</div>

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

	@include('admin.paginas.agenda.cultos.includes.scripts')

</x-slot:form>
