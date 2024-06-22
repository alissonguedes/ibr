<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.paginas.eventos.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Eventos </x-slot:title>

	<x-slot:body>

		<style>
			table.bordered tr th,
			table.bordered tr td {
				border: thin solid var(--grey-darken-4);
			}
		</style>

		@if (isset($posts) && $posts->count() > 0)
			<table class="bordered">
				<thead>
					<tr>
						<th class="center-align">Nome</th>
						<th class="center-align">CPF</th>
						<th class="center-align">RG</th>
						<th class="center-align">E-Mail</th>
						<th class="center-align">Telefone</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($posts as $post)
						<tr>
							<td class="left-align">{{ $post->inscrito }}</td>
							<td class="right-align">{{ $post->cpf }}</td>
							<td class="right-align">{{ $post->rg }}</td>
							<td class="center-align">{{ $post->email }}</td>
							<td class="center-align">{{ $post->telefone }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<div class="row">
				<div class="col s12">
					Nenhum evento cadastrado.
				</div>
			</div>
		@endif

		<style>
			.daterangepicker {
				z-index: 9999999999 !important;
				position: relative;
				background-color: var(--grey-darken-5) !important;
			}

			.daterangepicker .calendar-table {
				background-color: inherit !important;
				border: 1px solid var(--grey-darken-5) !important;
			}
		</style>

	</x-slot:body>

	{{-- @include('admin.paginas.eventos.includes.form') --}}

	@pushOnce('scripts')
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
		<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>
	@endPushOnce

</x-admin-layout>
