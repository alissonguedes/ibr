<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.categorias.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Categorias </x-slot:title>

	<x-slot:body>

		@if (isset($categorias) && $categorias->count() > 0)
			<div class="row">
				@foreach ($categorias as $categoria)
					<div class="col s12 m6 l4">
						<div class="card transparent">

							<div class="btn-group">
								<x-button class="btn activator btn-floating delete material-symbols-outlined font-weight-400">delete</x-button>
								<x-button class="icon-background edit" :data-href="route('admin.categorias.edit', $categoria->id)"> edit </x-button>
							</div>

							<div class="card-image">
								@if (!$categoria->status)
									<i class="inactive material-symbols-outlined"> visibility_off </i>
								@endif
								<img src="{{ route('categorias.show-image', $categoria->id) . '?action=preview' }}" height="210">
								{{-- <div class="delete activator material-symbols-outlined font-weight-400">delete</div> --}}
							</div>

							<div class="card-content"> </div>

							<div class="card-action">
								<span class="card-title light-green-text" style="">{{ $categoria->titulo }}</span>
								{{-- <x-button class="gradient-45deg-green-light-green black-text btn-small mr-3"> add </x-button> --}}
								{{-- <x-button class="icon-background gradient-45deg-green-light-green black-text btn-small right" :data-href="route('admin.categorias.edit', $categoria->id)"> edit </x-button> --}}
							</div>

							<div class="card-reveal red darken-4 white-text">
								<div class="row">
									<div class="col s12">
										Tem certeza que deseja remover este categoria?
									</div>
								</div>
								<br>
								<br>
								<div class="row">
									<div class="col s6 left-align">
										<button class="btn card-title white black-text waves-effect" style="font-size: inherit; font-family: inherit;">Não</button>
									</div>
									<form action="{{ route('admin.categorias.delete') }}" method="post">
										@csrf
										<input type="hidden" name="_method" value="delete">
										<input type="hidden" name="id" value="{{ $categoria->id }}">
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
					Nenhum categoria cadastrado.
				</div>
			</div>
		@endif

	</x-slot:body>

	@include('admin.categorias.includes.form')

	<x-slot:script>
		{{-- <script>
			$('.materialboxed').materialbox();
		</script> --}}
		<x-modal id="form_plano_saude">
			Teasdfste
		</x-modal>
	</x-slot:script>

</x-admin-layout>
