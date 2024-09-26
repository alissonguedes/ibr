<x-site-layout>

	<x-slot:body>

		<!--título da página-->
		<div class="title_page">AGENDA</div>

		<!--CONTEÚDO-->
		<div class="content_int">

			<h4>Comemorações & Festividades</h4>

			@if (isset($agenda) && $agenda->count() > 0)
				@php
					$dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
					$tipos = ['comemoracao' => 'Comemoração', 'aniversario' => 'Aniversário', 'culto' => 'Culto'];
				@endphp

				@foreach ($agenda as $a)
					<div class="conj_calendario">
						<div class="ico_calendar">
							<img src="{{ asset('assets/img/icon_calendar.png') }}" class="img_cem">
						</div>
						<div class="cont_calendar">
							<div class="data_h_calendar">
								@php
									$data_hora = json_decode($a->horarios, true);
								@endphp
								@if (!$data_hora)
									{{ show_date($a->data) }}
								@elseif (preg_match('/^(\d){4}\-(\d){2}\-(\d){2}$/', $a->horarios))
									{{ show_date($a->horarios, false) }}
								@else
									@if (is_array($data_hora))
										@foreach ($data_hora as $dia => $hora)
											@if (preg_match('/^(\d){4}\-(\d){2}\-(\d){2}$/', $dia))
												@php
													$hora_ini = date('H\hi', strtotime($hora['inicio']));
													$hora_fim = date('H\hi', strtotime($hora['fim']));
												@endphp
												{{ show_date($dia) }} · {{ date('H\hi', strtotime($hora_ini)) }}
											@else
												@foreach ($hora as $h)
													{{ $dias_semana[$dia] }} · {{ date('H\hi', strtotime($h['inicio'])) }} às {{ date('H\hi', strtotime($h['fim'])) }}
												@endforeach
											@endif
										@endforeach
									@endif
								@endif
							</div>
							<div class="name_calendar">{{ $a->titulo }}</div>
							<small class="mt-10">
								{{-- <i class="material-symbols-outlined">{{ $a->tipo_icon }}</i> --}}
								{{ $tipos[$a->tipo] }}
							</small>
						</div>

					</div>
				@endforeach
			@else
				<p>Nenhuma data disponível.</p>
			@endif

		</div>

		@if (isset($agenda) && $agenda->count() > 0)
			@php
				$data = request('ano') && request('mes') ? request('ano') . '-' . request('mes') . '-01' : 'now';
				$next_date = date('Y/m', strtotime($data . '+1 month'));
				$prev_date = date('Y/m', strtotime($data . '-1 month'));
			@endphp

			<div class="row">
				<div class="col s12 center-align">
					<a href="{{ route('site.agenda', $prev_date) }}" class="btn btn-floating light-green mr-10">
						<i class="material-symbols-outlined">arrow_back</i>
					</a>
					<a href="{{ route('site.agenda', $next_date) }}" class="btn btn-floating light-green ml-10">
						<i class="material-symbols-outlined">arrow_forward</i>
					</a>
				</div>
			</div>
		@endif

	</x-slot:body>

</x-site-layout>
