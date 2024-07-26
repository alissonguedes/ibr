<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.paginas.home.banners.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Banners </x-slot:title>

	<x-slot:body>

		@if (isset($banners) && $banners->count() > 0)
			<div class="row">
				@foreach ($banners as $banner)
					<div class="col s12 m6 l4">
						<div class="card transparent">

							@canany(['update', 'delete'], App\Models\Admin\BannerModel::class)
								<div class="btn-group">
									@can('delete', App\Models\Admin\BannerModel::class)
										<x-button class="btn activator btn-floating delete material-symbols-outlined font-weight-400">delete</x-button>
									@endcan
									@can('update', App\Models\Admin\BannerModel::class)
										<x-button class="icon-background edit" :data-href="route('admin.paginas.home.banners.edit', $banner->id)"> edit </x-button>
									@endcan
								</div>
							@endcan

							<div class="card-image">
								@if (!$banner->status)
									<i class="inactive material-symbols-outlined"> visibility_off </i>
								@endif
								<img src="{{ route('home.banners.show-image', $banner->id) . '?action=preview' }}" height="210">
								{{-- <div class="delete activator material-symbols-outlined font-weight-400">delete</div> --}}
							</div>

							<div class="card-content"> </div>

							<div class="card-action">
								<span class="card-title light-green-text" style="">{{ $banner->titulo }}</span>
								{{-- <x-button class="gradient-45deg-green-light-green black-text btn-small mr-3"> add </x-button> --}}
								{{-- <x-button class="icon-background gradient-45deg-green-light-green black-text btn-small right" :data-href="route('admin.paginas.home.banners.edit', $banner->id)"> edit </x-button> --}}
							</div>

							@can('delete', App\Models\Admin\BannerModel::class)
								<div class="card-reveal red darken-4 white-text">
									<div class="row">
										<div class="col s12">
											Tem certeza que deseja remover este banner?
										</div>
									</div>
									<br>
									<br>
									<div class="row">
										<div class="col s6 left-align">
											<button class="btn card-title white black-text waves-effect" style="font-size: inherit; font-family: inherit;">Não</button>
										</div>
										<form action="{{ route('admin.paginas.home.banners.delete') }}" method="post">
											@csrf
											<input type="hidden" name="_method" value="delete">
											<input type="hidden" name="id" value="{{ $banner->id }}">
											<div class="col s6 right-align">
												<button class="btn red waves-effect">Sim</button>
											</div>
										</form>
									</div>
								</div>
							@endcan

						</div>
					</div>
				@endforeach
			</div>
		@else
			<div class="row">
				<div class="col s12">
					Nenhum banner cadastrado.
				</div>
			</div>
		@endif

	</x-slot:body>

	@include('admin.paginas.home.banners.includes.form')

</x-admin-layout>
