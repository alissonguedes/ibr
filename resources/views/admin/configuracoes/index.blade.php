<x-admin-layout>

	<x-slot:icon> settings </x-slot:icon>
	<x-slot:title> Configurações </x-slot:title>

	<x-slot:body>

		<x-slot:main>

			<form action="{{ route('admin.configuracoes.index') }}" method="post" novalidate enctype="multipart/form-data" autocomplete="off">

				@csrf

				<div class="card card-panel">

					<div class="card-content">

						@include('admin.configuracoes.form')

					</div>

					<div class="card-action">
						<div class="row">
							<div class="col s12 right-align">
								<button type="reset" class="btn waves-effect">
									<i class="material-symbols-outlined left">cancel</i>
									<span>Cancelar</span>
								</button>
								<button type="submit" class="btn waves-effect">
									<i class="material-symbols-outlined left">save</i>
									<span>Salvar</span>
								</button>
							</div>
						</div>
					</div>

				</div>

			</form>

		</x-slot:main>

</x-admin-layout>
