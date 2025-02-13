<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.paginas.eventos.inscritos', request('id')) : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Inscrição </x-slot:title>

	<x-slot:main>

		@php
			$model = new App\Models\Model();
			$evento = $model->setConnection('site')->select('evento')->from('tb_evento')->where('id', $inscrito->evento)->first();
		@endphp

		<div class="card-panel">

			<div class="card-header bold uppercase">

				<span class="title bold">{{ $evento->evento }}</span>

				<div class="right">

					<button class="btn btn-flat gradient-45deg-green-light-green waves-effect white-text" data-tooltip="Alterar Inscrição" style="margin-right: 10px;">
						<i class="material-symbols-outlined">edit</i>
					</button>
					@php
						$boleto = $model->setConnection('site')->select('id')->from('tb_inscricao_boleto')->where('id_inscricao', $inscrito->idInscricao)->first();
					@endphp
					<button class="btn btn-flat gradient-45deg-green-light-green waves-effect white-text" data-tooltip="Boleto" @isset($boleto) data-href="{{ route('admin.paginas.eventos.boleto', $boleto->id) }}" @endisset>
						<i class="material-symbols-outlined">barcode</i>
					</button>

				</div>

			</div>

			<div class="card-content">

				<!-- BEGIN dados_pessoais -->
				<div id="dados_pessoais">

					<div class="row">
						<div class="col s12">
							<h5 class="form-title">
								<i class="material-symbols-outlined left">event</i>
								Dados Pessoais
							</h5>
						</div>
					</div>

					<div class="row">

						<div class="col s12 l6">
							<div class="input-field">
								<label for="nome" class="active">Nome</label>
								<input type="text" name="nome" id="nome" value="{{ $inscrito->nome }}" readonly disabled>
							</div>
						</div>

						<div class="col s12 l3">
							<div class="input-field">
								<label for="cpf">CPF</label>
								<input type="text" name="cpf" id="cpf" value="{{ $inscrito->cpf }}" readonly disabled>
							</div>
						</div>

						<div class="col s12 l3">
							<div class="input-field">
								<label for="rg">RG</label>
								<input type="text" name="rg" id="rg" value="{{ $inscrito->rg }}" readonly disabled>
							</div>
						</div>

					</div>

					<div class="row">

						<div class="col s12 l4">
							<div class="input-field">
								<label for="for" class="active">E-Mail</label>
								<input type="text" name="email" id="email" value="{{ $inscrito->email }}" readonly disabled>
							</div>
						</div>

						<div class="col s12 l3">
							<div class="input-field">
								<label for="telefone" class="active">Telefone</label>
								<input type="text" name="telefone" id="telefone" value="{{ $inscrito->telefone }}" readonly disabled>
							</div>
						</div>

						@php
							$cidade = $model->setConnection('site')->select('cidade')->from('tb_cidade')->where('id', $inscrito->id_cidade)->first();
							$estado = $model->setConnection('site')->select('uf')->from('tb_estado')->where('id', $inscrito->id_uf)->first();
						@endphp

						<div class="col s12 l3">
							<div class="input-field">
								<label for="cidade" class="active">Cidade</label>
								<input type="text" name="cidade" id="cidade" value="{{ $cidade->cidade }}" readonly disabled>
							</div>
						</div>

						<div class="col s12 l2">
							<div class="input-field">
								<label for="uf" class="active">UF</label>
								<input type="text" name="uf" id="uf" value="{{ $estado->uf }}" readonly disabled>
							</div>
						</div>

					</div>

				</div>
				<!-- END dados_pessoais -->

				<!-- BEGIN dados_inscricao -->
				<div id="dados_inscricao">

					<div class="row">
						<div class="col s12">
							<h5 class="form-title">
								<i class="material-symbols-outlined left">event</i>
								Inscrição
							</h5>
						</div>
					</div>

					<div class="row">
						<div class="col s12">
							<div class="input-field input-label disabled">
								<label for="">Evento</label>
								<span>{{ $evento->evento }}</span>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col s12 l6">
							<div class="input-field">
								<label for="codigo_inscricao">Código da Inscrição</label>
								<input type="text" name="codigo_inscricao" id="codigo_inscricao" value="{{ $inscrito->codigo }}" readonly disabled>
							</div>
						</div>

						<div class="col s12 l6">
							<div class="input-field input-label disabled">
								<label for="data_inscricao">Data/Hora da Inscrição</label>
								<span>{{ date('d/m/Y H:i:s', strtotime($inscrito->data_inscricao)) }}</span>
							</div>
						</div>
					</div>

				</div>
				<!-- BEGIN dados_inscricao -->

			</div>

		</div>

	</x-slot:main>

	{{-- @include('admin.paginas.eventos.includes.form') --}}

	@pushOnce('scripts')
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
		<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>
	@endPushOnce

</x-admin-layout>
