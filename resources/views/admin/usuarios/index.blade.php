<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.usuarios.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Usuários </x-slot:title>

	<x-slot:body>

		@php
			$niveis = [
			    'root' => 'Super Administrador',
			    'admin' => 'Administrador',
			    'pastor' => 'Pastor',
			    'financeiro' => 'Financeiro',
			];
		@endphp

		@if (isset($usuarios) && $usuarios->count() > 0)
			<div class="row">
				<div class="col s8">
					@include('admin.usuarios.includes.listar_usuarios')
				</div>
			</div>
		@else
			<div class="row">
				<div class="col s12">
					Nenhum usuário cadastrado.
				</div>
			</div>
		@endif

	</x-slot:body>

	@include('admin.usuarios.includes.form')

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
