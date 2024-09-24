<x-site-layout>

	<x-slot:body>

		<!--título da página-->
		<div class="title_page">AGENDA</div>

		<!--CONTEÚDO-->
		<div class="content_int">

			@if (isset($agenda) && $agenda->count() > 0)
				@php
					$dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
					$tipos = ['comemoracao' => 'Comemoração', 'aniversario' => 'Aniversário', 'culto' => 'Culto'];
				@endphp

				@foreach ($agenda as $a)
					@php
						$data_hora = json_decode($a->data_hora, true);
					@endphp
					@if (is_array($data_hora))
						@foreach ($data_hora as $dia => $hora)
							<div class="conj_calendario">
								<div class="ico_calendar"><img src="{{ asset('assets/img/icon_calendar.png') }}" class="img_cem"></div>
								<div class="cont_calendar">
									@if (preg_match('/^(\d){4}\-(\d){2}\-(\d){2}$/', $dia))
										@php
											$hora_ini = date('H\hi', strtotime($hora['inicio']));
											$hora_fim = date('H\hi', strtotime($hora['fim']));
										@endphp
										<div class="data_h_calendar">{{ show_date($dia) }} · {{ date('H\hi', strtotime($hora_ini)) }}</div>
									@else
										@foreach ($hora as $h)
											<div class="data_h_calendar">{{ $dias_semana[$dia] }} · {{ date('H\hi', strtotime($h['inicio'])) }} às {{ date('H\hi', strtotime($h['fim'])) }}</div>
										@endforeach
									@endif
									<div class="name_calendar">{{ $a->titulo }}</div>
									<small>
										{{-- <i class="material-symbols-outlined">{{ $a->tipo_icon }}</i> --}}
										{{ $tipos[$a->tipo] }}
									</small>
								</div>
							</div>
						@endforeach
					@endif
				@endforeach
			@else
				<p>Nenhuma data disponível.</p>
			@endif

		</div>

	</x-slot:body>

</x-site-layout>
