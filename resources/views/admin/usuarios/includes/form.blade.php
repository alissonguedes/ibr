<x-header-page data-href="{{ route('admin.usuarios.index') }}" placeholder="Pesquisar usuários..." title="Adicionar Banner">
	@can('create', App\Models\Admin\User::class)
		<x-slot:add_button>add</x-slot:add_button>
	@endcan
</x-header-page>

@php
	if (request('id')):
	    $id = $row->id;
	    $id_parent = $row->id_parent;
	    $usernivel = $row->nivel;
	    $name = $row->name;
	    $email = $row->email;
	    $descricao = $row->descricao;
	    $url = $row->url;
	    $status = $row->status;
	    $imagem = route('home.usuarios.show-image', $id) . '?action=preview';
	endif;
@endphp

<x-slot:form action="{{ route('admin.usuarios.post') }}" method="post" style="{{ $errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}" autocomplete="off">

	@csrf
	<input type="hidden" name="categoria" value="usuario">

	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	<div class="col row">

		<div class="col s12 l9">

			<!-- BEGIN título -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2 @error('nome') error @enderror">
						<label for="nome">Nome</label>
						<x-text-input type="text" name="name" id="name" :value="old('name', $name ?? null)" autofocus="autofocus" />
						@error('nome')
							<small class="error">{{ $message }}</small>
						@enderror
					</div>
				</div>
			</div>
			<!-- END título -->

			<!-- BEGIN Email -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2 @error('email') error @enderror">
						<label for="email">E-mail</label>
						<x-text-input type="email" name="email" id="email" :value="old('email', $email ?? null)" />
						@error('email')
							<small class="error">{{ $message }}</small>
						@enderror
					</div>
				</div>
			</div>
			<!-- END Email -->

			<!-- BEGIN Password -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2 @error('password') error @enderror">
						<label for="password">Senha</label>
						<x-text-input type="password" name="password" id="password" />
						@error('password')
							<small class="error">{{ $message }}</small>
						@enderror
					</div>
				</div>
			</div>
			<!-- END Password -->

			<!-- BEGIN Confirm Password -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2 @error('password_confirmation') error @enderror">
						<x-input-label for="password_confirmation" :value="__('Confirmar senha')" />
						<x-text-input type="password" name="password_confirmation" id="password_confirmation" />
						@error('password_confirmation')
							<small class="error">{{ $message }}</small>
						@enderror
					</div>
				</div>
			</div>
			<!-- END Password -->

			<!-- BEGIN título -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2 @error('nivel') error @enderror">
						<label for="nivel">Nível de acesso</label>

						<select name="nivel" id="nivel" class="white-text">
							<option value="" disabled selected>Informe o nível de acesso</option>
							@foreach ($niveis as $n => $i)
								@if (Auth::user()->nivel !== 'root' && $n === 'root')
									@continue
								@endif
								<option value="{{ $n }}" @selected(old('nivel' ?? $n == $usernivel))>{{ $i }}</option>
							@endforeach
						</select>
						@error('nivel')
							<small class="error">{{ $message }}</small>
						@enderror
					</div>
				</div>
			</div>
			<!-- END título -->

			<!-- BEGIN imagem -->
			<div class="row">
				<div class="col s12">
					<div class="file-field input-field @error('imagem') error @enderror">
						<div class="btn">
							<span>File</span>
							<x-text-input type="file" name="imagem" />
						</div>
						<div class="file-path-wrapper">
							<x-text-input type="text" class="file-path validate" />
						</div>
						@error('imagem')
							<small class="error">{{ $message }}</small>
						@enderror
					</div>
				</div>
			</div>
			<!-- END imagem -->

			<!-- BEGIN status -->
			<div class="row">
				<div class="col s12">
					<div class="input-field">
						<label for="status" class="">Ativo</label>
						<div class="switch">
							<label>
								Não
								<input type="checkbox" name="status" id="status" value="1" @checked(old() ? old('status') : (isset($status) ? $status : true))>
								<span class="lever"></span>
								Sim
							</label>
						</div>
					</div>
				</div>
			</div>
			<!-- END status -->

		</div>
	</div>

	<x-slot:card_footer>
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
	</x-slot:card_footer>

</x-slot:form>

{{-- <x-slot:scripts_form>
	<script src="{{ asset('assets/js/clinica/js/pacientes/form.js') }}" defer></script>
</x-slot:scripts_form> --}}
