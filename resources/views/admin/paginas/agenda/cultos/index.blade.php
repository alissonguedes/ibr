<x-admin-layout>

	<x-slot:icon> edit_calendar </x-slot:icon>
	<x-slot:title> Agenda · Cultos </x-slot:title>

	<x-slot:body>

		@if (isset($posts) && $posts->count() > 0)
			@php
				$dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
			@endphp
			<div class="masonry row">
				@foreach ($posts as $post)
					<div class="masonry-item col s12 m6 l4">
						<div class="card border-radius-20">

							@if (!$post->status)
								<i class="inactive material-symbols-outlined"> visibility_off </i>
							@endif
							<div class="btn-group">
								<x-button class="btn activator btn-floating delete material-symbols-outlined font-weight-400">delete</x-button>
								<x-button class="icon-background edit" :data-href="route('admin.paginas.agenda.cultos.edit', $post->id)"> edit </x-button>
							</div>

							<div class="card-stacked gradient-0deg-grey-grey">

								<div class="card-content center-align transparent grey-text">
									<h5 class="card-title bold mb-6 mt-0">{{ $post->titulo }}</h5>

									@php
										$horarios = [];
										$data_hora = json_decode($post->horarios, true);
									@endphp

									@if (isset($data_hora) && count($data_hora) > 0)
										<table>
											<tr>
												<th class="center-align bold">Dia</th>
												<th class="center-align bold">Horários</th>
											</tr>
											@foreach ($dias_semana as $d => $dia)
												@foreach ($data_hora as $data => $hora)
													<tr style="vertical-align: top; border: 1px solid var(--grey-lighten-1) !important;">
														@if ($d == $data)
															<th style="vertical-align: top; border: 1px solid var(--grey-lighten-1) !important;">{{ $dia }}</th>
															<td style="vertical-align: top; border: 1px solid var(--grey-lighten-1) !important;">
																@foreach ($hora as $h)
																	{{ date('H:i', strtotime($h['inicio'])) }} às {{ date('H:i', strtotime($h['fim'])) }}
																	<br>
																@endforeach
															</td>
														@endif
													</tr>
												@endforeach
											@endforeach
										</table>
									@endif

								</div>

							</div>

							<div class="card-reveal red darken-4 white-text">
								<div class="row">
									<div class="col s12">
										Tem certeza que deseja remover este evento?
									</div>
								</div>
								<br>
								<br>
								<div class="row">
									<div class="col s6 left-align">
										<button class="btn card-title white black-text waves-effect" style="font-size: inherit; font-family: inherit;">Não</button>
									</div>
									<form action="{{ route('admin.paginas.agenda.cultos.delete') }}" method="post">
										@csrf
										<input type="hidden" name="_method" value="delete">
										<input type="hidden" name="id" value="{{ $post->id }}">
										<div class="col s6 right-align">
											<button class="btn red waves-effect">Sim</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@else
			<div class="row">
				<div class="col s12">
					Nenhum evento cadastrado.
				</div>
			</div>
		@endif

	</x-slot:body>

	@include('admin.paginas.agenda.cultos.form')

</x-admin-layout>
