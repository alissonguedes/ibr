<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.categorias.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Categorias </x-slot:title>

	<x-slot:body>

		{{-- <table class="dataTable">
			<thead>
				<tr>
					<th class="center-align">Ícone</th>
					<th class="center-align">Título</th>
					<th class="center-align">Status</th>
				</tr>
			</thead>
		</table> --}}

		@include('admin.categorias.includes.listar_categorias')

	</x-slot:body>

	@include('admin.categorias.includes.form')

	<x-slot:script>
		<script>
			var updateOutput = function(e) {
				var list = e.length ? e : $(e.target);
				console.log(list.nestable('serialize'));
			};

			// activate Nestable for list 1
			$('.dd').nestable({
				group: 1
			}).on('change', updateOutput);
		</script>
	</x-slot:script>

</x-admin-layout>
