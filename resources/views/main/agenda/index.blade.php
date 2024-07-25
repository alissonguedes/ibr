<x-site-layout>

	<x-slot:body>

		<!--título da página-->
		<div class="title_page">AGENDA</div>

		<!--CONTEÚDO-->
		<div class="content_int">

			@if (isset($agenda) && $agenda->count() > 0)

				@foreach ($agenda as $a)
					<div class="conj_calendario">
						<div class="ico_calendar"><img src="{{ asset('assets/img/icon_calendar.png') }}" class="img_cem"></div>
						<div class="cont_calendar">
							<div class="data_h_calendar">{{ date('d/m/Y', strtotime($a->data_ini)) }} · {{ date('H\hi', strtotime($a->data_ini)) }} · {{ $a->local_evento }}</div>
							<div class="name_calendar">{{ $a->evento }}</div>
						</div>
					</div>
				@endforeach

			@endif

		</div>

	</x-slot:body>

</x-site-layout>
