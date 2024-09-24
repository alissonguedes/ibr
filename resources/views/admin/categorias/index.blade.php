<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.categorias.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Categorias </x-slot:title>

	<x-slot:body>

		@if (isset($categorias) && $categorias->count() > 0)
			<div class="row">
				<div class="col s8">
					{{-- <div class="dd"> --}}
					@include('admin.categorias.includes.listar_categorias')
					{{-- </div> --}}
				</div>
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

	@pushOnce('scripts')
		<script>
			var updateOutput = function(e) {
				var list = e.length ? e : $(e.target);
				console.log(list.nestable('serialize'));
			};

			$('.dd').nestable({
				group: 1
			}).on('change', updateOutput);
		</script>
	@endPushOnce

</x-admin-layout>
