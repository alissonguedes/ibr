<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.paginas.eventos.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Eventos </x-slot:title>

	<x-slot:body class="no-padding" style="height: calc(100% - 56px); top: auto; bottom: auto;">
		<div id="calendar"></div>
	</x-slot:body>

	@include('admin.paginas.eventos.includes.form')

	<x-slot:script>

		<script src="{{ asset('assets/node_modules/fullcalendar/index.global.min.js') }}"></script>
		<script>
			// document.addEventListener('DOMContentLoaded', function() {
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

					moreLinkContent: function(l) {
						return 'Mais ' + l.num;
					},

					dateClick: (a) => {
						console.log(a)
					},

					events: {
						url: BASE_URL + 'eventos',
						method: 'get',
						extraParams: {
							ajaxCalendar: true
						},
						success: (response) => {
							// progress('out');
						}
					},

				});

				calendar.render();

			});
		</script>

	</x-slot:script>

</x-admin-layout>
