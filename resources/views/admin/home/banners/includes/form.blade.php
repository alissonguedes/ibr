<x-header-page data-url="{{ route('admin.home.banners.index') }}" placeholder="Pesquisar banners..." title="Adicionar Banner">add</x-header-page>

@if (request('id'))
	@php
	@endphp
@endif

<x-slot:form action="{{ route('admin.home.banners.post') }}" method="post" style="{{ $errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}">

	@csrf

	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	{{-- <x-slot:form_tabs>
		<ul class="tabs tabs-fixed-width">
			<li class="tab"><a href="#dados-pessoais" class="active">Dados Pessoais</a></li>
			<li class="tab"><a href="#contato">Contato</a></li>
			<li class="tab"><a href="#endereco">Endereço</a></li>
			<li class="tab"><a href="#convenio">Convênio</a></li>
			<li class="tab"><a href="#observacoes">Observações</a></li>
			<li class="tab"><a href="#outras_informacoes">Outras informações</a></li>
		</ul>
	</x-slot:form_tabs> --}}

	<div class="row">

		<div class="col s12 m12 l12">

		</div>

	</div>

	<x-slot:card_footer>
		<div class="row">
			<div class="col s12 right-align">
				<button type="reset" class="btn grey-text text-darken-4 white waves-effect mr-3 left">
					<i class="material-symbols-outlined left">cancel</i>
					<span>Cancelar</span>
				</button>
				<button type="submit" class="btn green waves-effect">
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
