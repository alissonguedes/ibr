<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.paginas.eventos.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Eventos - Inscritos</x-slot:title>

	<x-slot:main>

		<div class="card-panel">

			<div class="card-header bold uppercase">
				<span class="title bold">{{ $row->evento }}</span>
				<span class="right bold"><span class="bold light-green-text">{{ $posts->count() }}</span> Inscritos</span>
			</div>

			<div class="card-content">

				@if (isset($posts) && $posts->count() > 0)
					<table class="bordered">
						<thead>
							<tr>
								<th class="center-align bold">Nome</th>
								<th class="center-align bold hide-on-med-and-down">CPF</th>
								<th class="center-align bold hide-on-med-and-down">RG</th>
								<th class="center-align bold hide-on-med-and-down">E-Mail</th>
								<th class="center-align bold hide-on-med-and-down">Telefone</th>
								{{-- <th class="center-align bold">Pago</th> --}}
								<th class="center-align bold">Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($posts as $post)
								<tr>
									<td class="left-align">{{ $post->inscrito }}</td>
									<td class="right-align hide-on-med-and-down">{{ $post->cpf }}</td>
									<td class="right-align hide-on-med-and-down">{{ $post->rg }}</td>
									<td class="center-align hide-on-med-and-down">{{ $post->email }}</td>
									<td class="center-align hide-on-med-and-down">{{ $post->telefone }}</td>

									@php

										$pago = '';
										$status = '';

										switch ($post->status) {
										    case '0':
										    default:
										        $status = '<span class="btn-floating btn-flat transparent status_inscricao blue-text text-accent-2" data-tooltip="Aguardando pagamento"><i class="material-symbols-outlined mr-2">hourglass_empty</i> <strong class="bold hide">Aguardando pagamento</strong> </span>';
										        break;
										    case 'C':
										        $status = '<span class="btn-floating btn-flat transparent status_inscricao red-text text-accent-2" data-tooltip="Cancelado"><i class="material-symbols-outlined mr-2">person_cancel</i> <strong class="bold hide">Cancelado</strong> </span>';
										        break;
										    case '1':
										        $status = '<span class="btn-floating btn-flat transparent status_inscricao green-text" data-tooltip="Confirmado"><i class="material-symbols-outlined mr-2">person_check</i> <strong class="bold hide">Confirmado</strong> </span>';
										        break;
										    case 'X':
										        $status = '<span class="btn-floating btn-flat transparent status_inscricao orange-text text-accent-2" data-tooltip="Não aceito"><i class="material-symbols-outlined mr-2">person_off</i> <strong class="bold hide">Não aceito</strong> </span>';
										        break;
										}

										// if ($post->pago > 0) {
										//     $pago = '<span class="btn-floating btn-flat transparent status_inscricao green-text" data-tooltip="Pago"><i class="material-symbols-outlined">check_circle</i></span>';
										// } else {
										//     $pago = '<span class="btn-floating btn-flat transparent status_inscricao red-text text-accent-2" data-tooltip="Não pago"><i class="material-symbols-outlined">cancel</i></span>';
										// }

										$acao = '<button type="button" class="btn btn-floating btn-flat transparent white-text" data-href="' . route('admin.paginas.eventos.inscricao', [request('id'), $post->id]) . '" data-tooltip="Ver Inscrição"><i class="material-symbols-outlined">visibility</i></button>';

									@endphp

									{{-- <td class="center-align">{!! $pago !!}</td> --}}
									<td class="center-align">{!! $status !!}</td>
									<td class="center-align">{!! $acao !!}</td>
									{{-- event_busy --}}
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<div class="row">
						<div class="col s12">
							Ninguém se inscreveu ainda para este evento.
						</div>
					</div>
				@endif

				<style>
					table.bordered tr th,
					table.bordered tr td {
						border: thin solid var(--grey-darken-4);
					}

					.daterangepicker {
						z-index: 9999999999 !important;
						position: relative;
						background-color: var(--grey-darken-5) !important;
					}

					.daterangepicker .calendar-table {
						background-color: inherit !important;
						border: 1px solid var(--grey-darken-5) !important;
					}

					.status_inscricao {
						/* display: flex;
						place-content: center;
						align-items: center;
						cursor: pointer; */
					}
				</style>

			</div>

		</div>

	</x-slot:main>

	{{-- @include('admin.paginas.eventos.includes.form') --}}

	@pushOnce('scripts')
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
		<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>
	@endPushOnce

</x-admin-layout>
