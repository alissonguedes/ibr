<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.paginas.eventos.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Eventos </x-slot:title>

	<x-slot:main>
		<div class="card-panel">
			<div class="card-content pt-1 pb-1 pl-0 pr-0" style="height: calc(100% - 0px);">
				<div id="calendar"></div>
			</div>
		</div>
	</x-slot:main>

	@include('admin.paginas.eventos.includes.form')

	<x-slot:script>

		<script src="{{ asset('assets/node_modules/fullcalendar/index.global.min.js') }}"></script>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
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
					}

				});

				calendar.render();

			});
		</script>

	</x-slot:script>

</x-admin-layout>
