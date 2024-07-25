<x-header-page data-href="{{ route('admin.usuarios.index') }}" placeholder="Pesquisar usuários..." title="Adicionar Banner">add</x-header-page>

@php
	if (request('id')):
	    $id = $row->id;
	    $id_parent = $row->id_parent;
	    $name = $row->name;
	    $email = $row->email;
	    $descricao = $row->descricao;
	    $url = $row->url;
	    $status = $row->status;
	    // $imagem = route('admin.usuarios.show-image', $id) . '?action=preview';
	endif;
@endphp

<x-slot:form action="{{ route('admin.usuarios.post') }}" method="post" style="{{ $errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}" autocomplete="off">

	@csrf

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
						<input type="text" name="name" id="name" :value="old('name', $name ?? null)" autofocus="autofocus" />
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
						<input type="email" name="email" id="email" :value="old('email', $email ?? null)">
						@error('email')
							<small class="error">{{ $message }}</small>
						@enderror
					</div>
				</div>
			</div>
			<!-- END Email -->

			<!-- Password -->
			<div class="mt-4">
				<x-input-label for="password" :value="__('Password')" />
				<x-text-input type="password" name="password" id="password" class="block mt-1 w-full" required autocomplete="new-password" />
				<x-input-error class="mt-2" :messages="$errors->get('password')" />
			</div>

			<!-- Confirm Password -->
			<div class="mt-4">
				<x-input-label for="password_confirmation" :value="__('Confirm Password')" />
				<x-text-input type="password" name="password_confirmation" id="password_confirmation" class="block mt-1 w-full" required autocomplete="new-password" />
				<x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
			</div>

			<!-- BEGIN título -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2 @error('titulo_slug') error @enderror">
						<label for="titulo_slug">Rótulo do campo</label>
						<x-text-input type="text" name="titulo_slug" id="titulo_slug" :value="old('titulo_slug', $titulo_slug ?? null)" />
						@error('titulo_slug')
							<small class="error">{{ $message }}</small>
						@enderror
					</div>
				</div>
			</div>
			<!-- END título -->

			<!-- BEGIN título -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2 @error('titulo_slug') error @enderror">
						<label for="titulo_slug">Categoria</label>
						@php
							$cats = new App\Models\Admin\CategoriaModel();
							if (!isset($id)) {
							    $cats = $cats->all();
							} else {
							    $cats = $cats->where('id', '<>', $id)->get();
							}
						@endphp

						<select name="id_parent" id="id_parent">
							<option value="" selected>Sem categoria</option>
							@if ($cats->count() > 0)
								@foreach ($cats as $cat)
									<option value="{{ $cat->id }}" @selected(isset($id_parent) && $id_parent === $cat->id)>{{ $cat->titulo }}</option>
								@endforeach
							@endif
						</select>

						@error('titulo_slug')
							<small class="error">{{ $message }}</small>
						@enderror
					</div>
				</div>
			</div>
			<!-- END título -->

			<!-- BEGIN descrição -->
			<div class="row">
				<div class="col s12">
					<div class="input-field amber-text mb-2">
						<label for="descricao">Descrição</label>
						<x-text-input type="text" name="descricao" id="descricao" :value="old('descricao', $descricao ?? null)" />
					</div>
				</div>
			</div>
			<!-- END descrição -->

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
