<x-admin-layout>

	<x-slot:icon> dashboard </x-slot:icon>
	<x-slot:title> Dashboard </x-slot:title>

	<x-slot:body>

		<div class="row">

			<div class="col s12 m6 l6 xl3">
				<div class="card gradient-45deg-light-green-green gradient-shadow min-height-100 white-text animate fadeLeft">
					<div class="padding-4">
						<div class="row">
							<div class="col s7 m7">
								<i class="material-symbols-outlined background-round mt-5">group</i>
							</div>
							<div class="col s5 m5 right-align">
								<p class="no-margin">Usuários</p>
								<h5 class="mt-0 white-text">{{ App\Models\User::where('status', '1')->count() }}</h5>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col s12 m6 l6 xl3">
				<div class="card gradient-45deg-green-light-green gradient-shadow min-height-100 white-text animate fadeLeft">
					<div class="padding-4">
						<div class="row">
							<div class="col s7 m7 white-text text-darken-4">
								<i class="material-symbols-outlined background-round mt-5">category</i>
							</div>
							<div class="col s5 m5 right-align">
								<p class="no-margin">Categorias</p>
								<h5 class="mt-0 white-text">{{ App\Models\Admin\CategoriaModel::where('status', '1')->count() }}</h5>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col s12 m6 l6 xl3">
				<div class="card gradient-45deg-light-green-green gradient-shadow min-height-100 white-text animate fadeLeft">
					<div class="padding-4">
						<div class="row">
							<div class="col s7 m7">
								<i class="material-symbols-outlined background-round mt-5">wallpaper_slideshow</i>
							</div>
							<div class="col s5 m5 right-align">
								<p class="no-margin">Banners</p>
								<h5 class="mt-0 white-text">{{ App\Models\Admin\BannerModel::where('titulo_slug', '<>', 'slideshow-container')->where('categoria', 'banner')->where('status', '1')->count() }}</h5>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col s12 m6 l6 xl3">
				<div class="card gradient-45deg-green-light-green gradient-shadow min-height-100 white-text animate fadeLeft">
					<div class="padding-4">
						<div class="row">
							<div class="col s7 m7">
								<i class="material-symbols-outlined background-round mt-5">group</i>
							</div>
							<div class="col s5 m5 right-align">
								<p class="no-margin">Postagens</p>
								<h5 class="mt-0 white-text">{{ App\Models\Admin\PostModel::where('status', '1')->where('tipo', 'post')->where('categoria', 'post')->count() }}</h5>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

		<div class="row">
			<div class="col s12 m12 l9">
				<div class="card subscriber-list-card animate fadeRight grey darken-5" style="height: 456px;">
					<div class="card-content">
						<h4 class="card-title white-text mb-0 mt-0">
							<i class="material-symbols-outlined float-left mr-1" style="font-size: 36px;">event</i>
							Eventos
						</h4>
					</div>
					@php
						$inscritoModel = new App\Models\Admin\InscricaoModel();
						$eventoModel = new App\Models\Admin\EventoModel();
						$eventos = $eventoModel->where('tipo', 'E')->orderBy('data_ini', 'asc')->limit(6)->get();
					@endphp
					<style>
						table.bordered tr {
							border-width: 1px;
							border-style: solid;
							border-color: var(--grey-darken-5);
							border-left-width: 0;
							border-right-width: 0;
						}
					</style>
					<table class="responsive-table bordered">
						<thead>
							<tr>
								<th class="center-align">Nome</th>
								<th class="center-align">Data</th>
								<th class="center-align">Inscrições</th>
								{{-- <th class="center-align">Local</th> --}}
								<th class="center-align">Total de inscritos</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($eventos as $e)
								<tr>
									<td class="center-align">{{ $e->evento }}</td>
									<td class="center-align">{{ date('d/m/Y', strtotime($e->data_ini)) }}</td>
									<td class="center-align">{{ date('d/m/Y', strtotime($e->data_inscricao_ini)) }} - {{ date('d/m/Y', strtotime($e->data_inscricao_fim)) }}</td>
									{{-- <td class="center-align">{{ $e->local_evento }}</td> --}}
									<td class="center-align">{{ $inscritoModel->getInscritos($e->id)->count() }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="col s12 m12 l3">
				<div class="card padding-4 animate fadeLeft">
					<div class="row">
						<div class="col s5 m5">
							<h5 class="mb-0 white-text">{{ App\Models\Admin\MinisterioModel::where('categoria', 'ministerio')->count() }}</h5>
							<p class="no-margin white-text">Ministérios</p>
						</div>
						<div class="col s7 m7 right-align">
							<i class="material-symbols-outlined background-round mt-5 mb-5 gradient-45deg-green-light-green gradient-shadow white-text">diversity_3</i>
						</div>
					</div>
				</div>
			</div>
			<div class="col s12 m12 l3">
				<div class="card padding-4 animate fadeLeft">
					<div class="row">
						<div class="col s5 m5">
							<h5 class="mb-0 white-text">{{ App\Models\Admin\CultoModel::where('categoria', 'culto')->count() }}</h5>
							<p class="no-margin white-text">Cultos</p>
						</div>
						<div class="col s7 m7 right-align">
							<i class="material-symbols-outlined background-round mt-5 mb-5 gradient-45deg-green-light-green gradient-shadow white-text">diversity_3</i>
						</div>
					</div>
				</div>
			</div>
			<div class="col s12 m12 l3">
				<div class="card padding-4 animate fadeLeft">
					<div class="row">
						<div class="col s5 m5">
							<h5 class="mb-0 white-text">{{ App\Models\Admin\EventoModel::where('tipo', 'E')->count() }}</h5>
							<p class="no-margin white-text">Eventos</p>
						</div>
						<div class="col s7 m7 right-align">
							<i class="material-symbols-outlined background-round mt-5 mb-5 gradient-45deg-green-light-green gradient-shadow white-text">diversity_3</i>
						</div>
					</div>
				</div>
			</div>
			<div class="col s12 m12 l3">
				<div class="card padding-4 animate fadeLeft">
					<div class="row">
						<div class="col s5 m5">
							<h5 class="mb-0 white-text">{{ App\Models\Admin\PastorModel::count() }}</h5>
							<p class="no-margin white-text">Pastores</p>
						</div>
						<div class="col s7 m7 right-align">
							<i class="material-symbols-outlined background-round mt-5 mb-5 gradient-45deg-green-light-green gradient-shadow white-text">diversity_3</i>
						</div>
					</div>
				</div>
			</div>
		</div>

	</x-slot:body>

	<x-slot:script>
		{{-- <script src="{{ asset('assets/scripts/app/clinica/core.js') }}"></script> --}}
	</x-slot:script>

</x-admin-layout>
