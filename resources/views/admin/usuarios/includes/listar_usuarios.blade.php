@foreach ($usuarios as $usuario)
	<div class="col s6 m3 l3 mb-3">
		<div class="avatar card transparent z-depth-0 no-padding">

			@if (!$usuario->status)
				<i class="inactive material-symbols-outlined"> visibility_off </i>
			@endif

			<div class="card-image">
				<div class="circle light-green-border border-lighten-4 border-10">
					<img src="{{ route('home.usuarios.show-image', $usuario->id) . '?action=preview' }}">
					<div class="btn-group">
						<x-button class="btn activator btn-floating delete material-symbols-outlined font-weight-400">delete</x-button>
						<x-button class="icon-background btn btn-floating edit material-symbols-outlined font-weight-400" :data-href="route('admin.usuarios.edit', $usuario->id)"> edit </x-button>
					</div>
				</div>
			</div>

			<div class="card-content no-margin no-padding center-align black-text">
				<h5 class="white-text">
					{{ $usuario->name }}
					<br>
					<small class="light-green-text">{{ $niveis[$usuario->nivel] }}</small>
				</h5>
			</div>

			<div class="card-reveal red darken-4 white-text">
				<div class="row">
					<div class="col s12">
						Tem certeza que deseja remover este usuario?
					</div>
				</div>
				<br>
				<br>
				<div class="row">
					<div class="col s6 left-align">
						<button class="btn card-title white black-text waves-effect" style="font-size: inherit; font-family: inherit;">Não</button>
					</div>
					<form action="{{ route('admin.usuarios.delete') }}" method="post">
						@csrf
						<input type="hidden" name="_method" value="delete">
						<input type="hidden" name="id" value="{{ $usuario->id }}">
						<div class="col s6 right-align">
							<button class="btn red waves-effect">Sim</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endforeach
