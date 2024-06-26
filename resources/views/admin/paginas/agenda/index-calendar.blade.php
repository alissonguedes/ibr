<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.paginas.eventos.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Agenda </x-slot:title>

	<x-slot:main>

		<div class="card card-panel no-padding">

			<section class="card-header animated fadeIn">
				<div id="search-on-page">
					<button id="open-search" class="btn btn-floating btn-flat mr-3 waves-effect waves-green white-text">
						<i class="material-symbols-outlined">search</i>
					</button>
					<x-text-input type="search" id="input-search-header" :data-url="route('admin.paginas.a-ibr.index')" placeholder="Pesquisar eventos" autocomplete="off" />
				</div>
				<x-button type="button" id="card-button" class="btn btn-floating waves-effect" data-href="{{ route('admin.paginas.agenda.index') }}" data-tooltip="Adicionar Evento">
					add
				</x-button>
			</section>

			<div class="card-content no-padding">

				<div class="card agenda no-margin black">
					<div class="card-content no-padding">
						<div id="calendar"></div>
					</div>
					<div id="datails" class="card-reveal grey-text no-padding" style="{{ $errors->any() || (request('year') && request('month') && request('day')) ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}" autocomplete="off" novalidate>
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
							@php
								$fator = 60; // a cada 15 minutos;
								$sub = 1; // subtrair 1 minuto (evitar minutos quebrados)
							@endphp
							@for ($h = 0; $h < 24; $h++)
								@for ($m = 0; $m < 60; $m++)
									<table id="programacao" class="table display mb-1">
										<thead>
											<tr>
												<th class="hora">
													{{ ($h < 10 ? '0' : null) . $h }}:{{ ($m < 10 ? '0' : null) . $m }} AM
													· Total agendados {{ $m }}
												</th>
											</tr>
										</thead>
										<tbody>
											@for ($i = 0; $i < 2; $i++)
												<tr>
													<td>
														Alisson Guedes · Dr. Raul ─ Cardiologista
													</td>
												</tr>
											@endfor
										</tbody>
									</table>
									@php
										$m = $m + $fator - $sub;
									@endphp
								@endfor
							@endfor
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

	@pushOnce('scripts')
		<script src="{{ asset('assets/node_modules/fullcalendar/index.global.min.js') }}"></script>

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
								var form = $(response).find('#datails.card-reveal');
								$('#datails.card-reveal').html(form.html());
								$('#datails.card-reveal').css({
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
	@endPushOnce

</x-admin-layout>
