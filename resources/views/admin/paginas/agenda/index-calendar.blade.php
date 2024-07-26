<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.paginas.eventos.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Agenda </x-slot:title>

	<x-slot:main>

		<div class="card card-panel no-padding">

			<section class="card-header animated fadeIn">

				<div class="column-left">
					<div id="search-on-page">
						<button id="open-search" class="btn btn-floating btn-flat mr-3 waves-effect waves-green white-text">
							<i class="material-symbols-outlined">search</i>
						</button>
						<x-text-input type="search" id="input-search-header" :data-url="route('admin.paginas.a-ibr.index')" placeholder="Pesquisar eventos" autocomplete="off" />
					</div>
				</div>
				<div class="column-center" style="width: calc(100% - 130px);">

					<div class="">
						<button type="button" id="calendar-btn-back" class="btn btn-floating btn-flat waves-effect waves-teal transparent material-symbols-outlined white-text no-margin" data-tooltip="Adicionar Evento">
							arrow_back
						</button>
						<button type="button" id="calendar-btn-forward" class="btn btn-floating btn-flat waves-effect waves-teal transparent material-symbols-outlined white-text no-margin" data-tooltip="Adicionar Evento">
							arrow_forward
						</button>
						<button type="button" id="calendar-btn-back" class="btn waves-effect waves-teal transparent outlined border white-text no-margin" data-tooltip="Adicionar Evento">
							Hoje
						</button>
					</div>

					<div class="">
						<!-- Dropdown Trigger -->
						<button class="btn transparent z-depth-0 dropdown-trigger" data-target="dropdown1">
							<span>{{ date('M, d Y') }}</span>
							<i class="material-symbols-outlined right">
								arrow_drop_down
							</i>
						</button>
					</div>

					<div class="">
						<!-- Dropdown Structure -->
						<ul id="dropdown1" class="dropdown-content">
							<li><a href="#!">one</a></li>
							<li><a href="#!">two</a></li>
							<li class="divider" tabindex="-1"></li>
							<li><a href="#!">three</a></li>
							<li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
							<li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
						</ul>

						<!-- Dropdown Trigger -->
						<button class="dropdown-trigger btn" data-target="dropdown1">
							Drop Me!
							<i class="material-symbols-outlined right">
								arrow_drop_down
							</i>
						</button>

						<!-- Dropdown Structure -->
						<ul id='dropdown1' class='dropdown-content'>
							<li><a href="#!">one</a></li>
							<li><a href="#!">two</a></li>
							<li class="divider" tabindex="-1"></li>
							<li><a href="#!">three</a></li>
							<li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
							<li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
						</ul>
					</div>
				</div>
				<div class="column-right">
					@can('create', App\Models\Admin\AgendaModel::class)
						<x-button type="button" id="card-button" class="btn btn-floating waves-effect" data-href="{{ route('admin.paginas.agenda.index') }}" data-tooltip="Adicionar Evento">
							add
						</x-button>
					@endcan
				</div>

			</section>

			<style>
				.column-center {
					width: calc(100% - 120px);
					display: flex;
					align-items: center;
					place-content: space-between;
				}

				.card-header.open .column-center {
					display: none;
				}
			</style>
			<div class="card-content no-padding">

				<div class="card agenda no-margin black">
					<div class="card-content no-padding">
						<div id="calendar"></div>
					</div>
					<div id="details" class="card-reveal grey-text no-padding" style="{{ $errors->any() || (request('year') && request('month') && request('day')) ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}" autocomplete="off" novalidate>
						<div class="card-title grey-text text-darken-4 pl-2 pr-2 pt-2 pb-0">
							<i class="material-symbols-outlined right white-text">close</i>
							<div class="date z-depth-2" style="background: var(--gradient-45deg-green-light-green);">
								@php
									$dias_semana = ['Dom.', 'Seg.', 'Ter.', 'Qua.', 'Qui.', 'Sex.', 'Sáb.'];
									$dia = request('day') ?? null;
									$mes = request('month') ?? null;
									$ano = request('year') ?? null;
									$date = strtotime($ano . '-' . $mes . '-' . $dia);
								@endphp
								@if (!is_null($dia))
									<small class="uppercase">{{ $dias_semana[date('w', $date)] }}</small>
									<span>{{ date('d', $date) }}</span>
								@endif
							</div>
						</div>

						<div class="padding-2" style="overflow: auto; max-height: calc(100% - 110px); position: relative;">
							@if (isset($eventos_dia) && $eventos_dia->count() > 0)
								@php
									$categoriaModel = new App\Models\Admin\AgendaModel();
									$horarios = [];
								@endphp
								@foreach ($eventos_dia as $evento)
									@php

										$hora_ini = date('H:i', strtotime($evento->data_ini));

									@endphp

									@php
										$hora_ini = date('H:i', strtotime($evento->data_ini));
										$hora_fim = date('H:i', strtotime($evento->data_fim));

										$time = explode(':', $hora_ini);
										$h = $time[0];
										$m = $time[1];

										$icon_event = $categoriaModel
										    ->select('titulo AS categoria', 'icon')
										    ->from('tb_evento_categoria')
										    ->where('id', $evento->id_categoria)
										    ->get()
										    ->first();

										$e = [
										    'id' => $evento->id,
										    'categoria' => $icon_event->categoria,
										    'categoria_icon' => $icon_event->icon,
										    'titulo' => $evento->evento,
										    'ano' => date('Y', strtotime($evento->data_ini)),
										    'mes' => date('m', strtotime($evento->data_ini)),
										    'dia' => date('d', strtotime($evento->data_ini)),
										    'hora_ini' => $hora_ini,
										    'hora_fim' => $hora_fim,
										    'tipo' => $evento->tipo === 'E' ? 'Evento' : ($evento->tipo === 'A' ? 'Agendamento' : ''),
										    'dia_inteiro' => $evento->dia_inteiro,
										];

										if ($evento->dia_inteiro === '1'):
										    $horarios['all_day'][] = $e;
										else:
										    $horarios[$h][] = $e;
										endif;

									@endphp
								@endforeach

								@if (!empty($horarios))
									@foreach ($horarios as $ind => $horario)
										<table class="table display mb-1">
											<thead>
												<tr>
													<th class="hora">Horário: {{ $ind === 'all_day' ? 'O Dia Todo' : $ind . 'h00' }}</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($horario as $hora)
													<tr>
														<td>
															<a href="{{ route('admin.paginas.agenda.date.edit', ['year' => request('year'), 'month' => request('month'), 'day' => request('day'), 'id' => $hora['id']]) }}" class="flex flex-center">
																<span class="ml-1 grey-text text-darken-2">{{ $hora['hora_ini'] }}</span>
																<i class="material-symbols-outlined lightgreen-text pointer ml-1 mr-1" data-tooltip="{{ $hora['categoria'] }}">{{ $hora['categoria_icon'] }}</i>
																<span class="light-green-text">{{ $hora['titulo'] }}</span>
															</a>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									@endforeach
								@endif
							@else
								Sem agendamentos nesta data.
							@endif
						</div>
					</div>
				</div>
			</div>

			@include('admin.paginas.agenda.includes.form')

		</div>
		<style>
			table.programacao {
				margin-bottom: 30px;
			}

			td,
			th {
				border-radius: 0 !important;
				border: 1px solid var(--grey-darken-3);
			}

			main .card-panel>.card-header~.card-content {
				height: calc(100% - 56px);
				top: auto;
				bottom: 0px;
			}

			.card.agenda {
				position: relative;
				overflow: hidden;
				height: 100%;
			}

			.card.agenda .card-content {
				height: 100%;
				position: absolute;
				left: 0;
				top: 0;
				right: 0;
				bottom: 0;
				background-color: inherit;
			}

			.card .card-reveal {
				background-color: inherit;
				z-index: 999999;
			}

			.card.agenda .card-title .date {
				font-family: 'Montserrat Bold';
				display: flex;
				flex-direction: column;
				align-items: center;
				place-content: center;
				background: var(--light-green);
				width: 70px;
				height: 70px;
				border-radius: 100%;
				/* margin-left: 3px;
				margin-top: 3px; */
			}

			.card.agenda .date * {
				font-family: inherit;
				line-height: 24px;
			}

			th.hora {
				padding: 10px;
				font-family: 'Montserrat Bold';
				background-color: var(--grey-darken-4);
				color: #fff;
				border-radius: 4px;
			}

			.fc .fc-more-link,
			.fc .fc-event {
				color: var(--light-green);
				font-family: 'Montserrat Bold';
				font-size: 10px;
			}
		</style>
	</x-slot:main>

	@pushOnce('plugins_css')
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	@endPushOnce

	@pushOnce('scripts')
		<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>
		<script src="{{ asset('assets/node_modules/fullcalendar/index.global.min.js') }}"></script>

		{{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
		<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

		<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>
		--}}

		<script>
			$(function() {

				var calendarEl = document.getElementById('calendar');
				var calendar = new FullCalendar.Calendar(calendarEl, {
					initialView: 'dayGridMonth',
					timeZone: 'America/Sao_Paulo',
					locale: 'pt-br',
					headerToolbar: false,

					dayMaxEvents: true,
					height: '100%',
					contentHeight: '100%',
					fixedWeekCount: true,
					expandRows: true,
					lazyFetching: true,
					nowIndicator: true,

					// eventDisplay: 'inverse-background',
					// eventDisplay: 'block',

					moreLinkContent: function(l) {
						return 'Mais ' + l.num;
					},

					eventClick: (e) => {

						e.jsEvent.preventDefault();

						var id = e.event.id;
						var url = e.event.url;

						$('form.card-reveal').show();
						calendar.refetchEvents();

						if (typeof url !== 'undefined') {

							Url.update(url);

							$.ajax({
								url: url,
								method: 'get',
								success: (response) => {

									console.log(response);
									var form = $(response).find('form.card-reveal');

									$('form.card-reveal').html(form.html());
									$('form.card-reveal').css({
										'transform': 'translateY(-100%)',
									});

									$.getScript(BASE_PATH + 'assets/js/app.js');
									calendar.refetchEvents();
								}
							});
						}

					},

					dateClick: (a) => {

						var url = BASE_URL + 'agenda/' + a.dateStr.replaceAll('-', '/');

						Url.update(url);

						$.ajax({
							url: url,
							method: 'get',
							success: (response) => {
								var form = $(response).find('#details.card-reveal');
								$('#details.card-reveal').html(form.html());
								$('#details.card-reveal').css({
									'display': 'block',
									'transform': 'translateY(-100%)',
								});
								$.getScript(BASE_PATH + 'assets/js/app.js');
								calendar.refetchEvents();
							}
						});

						calendar.refetchEvents();

					},

					events: {
						url: BASE_URL + 'agenda',
						method: 'get',
						extraParams: {
							ajaxCalendar: true
						},
						success: (response) => {

						},
						color: 'var(--light-green)', // an option!
						textColor: 'black' // an option!
					},

				});

				calendar.render();

			});
		</script>

		<style>
			.daterangepicker {
				z-index: 9999999999 !important;
				/* position: relative; */
				background-color: var(--grey-darken-5) !important;
			}

			.daterangepicker .calendar-table {
				background-color: inherit !important;
				border: 1px solid var(--grey-darken-5) !important;
			}
		</style>
	@endPushOnce

</x-admin-layout>
