@php

	$config = new App\Models\ConfigModel();

	config($config->getAllConf());

@endphp

<!-- BEGIN card Informações -->
<div class="row">

	<!-- BEGIN col.s6 -->
	<div class="col l6 s12 no-padding">

		<!-- BEGIN col s12 -->
		<div class="col s12">

			<!-- BEGIN card.bg-opacity -->
			<div class="card">

				<!-- BEGIN card-content -->
				<div class="card-content padding-6">

					<div class="row">
						<h3 class="card-title white-text">
							<i class="material-symbols-outlined left">domain</i>
							Dados do Site
						</h3>
					</div>

					<!-- BEGIN Título do Site -->
					<div class="row">
						<div class="input-field">
							<label class="">Título do site</label>
							<input type="text" name="site_title" id="site_title" value="{{ config('site.site_title') }}">
						</div>
					</div>
					<!-- END Título do Site -->

					<!-- BEGIN Descrição do site -->
					<div class="row">
						<div class="input-field">
							<label class="">Descrição do site</label>
							<input type="url" name="site_description" id="site_description" value="{{ config('site.site_description') }}" maxlength="160">
						</div>
					</div>

				</div>
				<!-- END card-content -->

			</div>
			<!-- END card.bg-opacity -->

		</div>
		<!-- END col s12 -->

		<!--------------------------------------------------------->

		<!-- BEGIN col s12 -->
		<div class="col s12">

			<!-- BEGIN card.bg-opacity -->
			<div class="card">

				<!-- BEGIN card-content -->
				<div class="card-content padding-6">

					<div class="row">
						<h3 class="card-title white-text">
							<i class="material-symbols-outlined left">forum</i>
							Contatos
						</h3>
					</div>

					<!-- BEGIN Empresa -->
					<div class="row">
						<div class="input-field">
							<label class="">E-Mail</label>
							<input type="email" name="contact_email" id="contact_email" value="{{ config('site.contact_email') }}">
						</div>
					</div>
					<!-- END Empresa -->

					<!-- BEGIN Telefone -->
					<div class="row">
						<div class="input-field">
							<label class=" {{ !empty(config('site.contact_phone')) ? 'active' : null }}">Telefone</label>
							<input type="tel" name="contact_phone" id="contact_phone" class="box_input is_phone" value="{{ config('site.contact_phone') }}">
						</div>
					</div>
					<!-- END Telefone -->

					<!-- BEGIN Celular -->
					<div class="row">
						<div class="input-field">
							<label class=" {{ !empty(config('site.contact_cel')) ? 'active' : null }}">Whatsapp</label>
							<input type="tel" name="contact_cel" id="contact_cel" class="box_input is_celular" value="{{ config('site.contact_cel') }}">
						</div>
					</div>
					<!-- END Celular -->

				</div>
				<!-- END card-content -->

			</div>
			<!-- END card.bg-opacity -->

		</div>
		<!-- END col s12 -->

	</div>
	<!-- END col.l6.s12 -->

	<!-- BEGIN col.l6.s12 -->
	<div class="col l6 s12 no-padding">

		<!-- BEGIN col s12 -->
		<div id="informations" class="col s12">

			<!-- BEGIN card.bg-opacity -->
			<div class="card">

				<!-- BEGIN card-content -->
				<div class="card-content padding-6">

					<div class="row">
						<h3 class="card-title white-text">
							<i class="material-symbols-outlined left">share</i>
							Redes Sociais
						</h3>
					</div>

					<!-- BEGIN Facebook -->
					<div class="row">
						<div class="input-field">
							<label class="">Facebook</label>
							<input type="url" name="facebook" id="facebook" value="{{ config('site.facebook') }}">
						</div>
					</div>
					<!-- END Facebook -->

					<!-- BEGIN Instagram -->
					<div class="row">
						<div class="input-field">
							<label class="">Instagram</label>
							<input type="url" name="instagram" id="instagram" value="{{ config('site.instagram') }}">
						</div>
					</div>
					<!-- END Instagram -->

					<!-- BEGIN YouTube -->
					<div class="row">
						<div class="input-field">
							<label class="">YouTube</label>
							<input type="url" name="youtube" id="linkedin" value="{{ config('site.youtube') }}">
						</div>
					</div>
					<!-- END YouTube -->

				</div>
				<!-- END card-content -->

			</div>
			<!-- END card.bg-opacity -->

		</div>
		<!-- END col s12 -->

		<!--------------------------------------------------------->

		<!-- BEGIN col s12 -->
		<div class="col s12">

			<!-- BEGIN card.bg-opacity -->
			<div class="card">

				<!-- BEGIN card-content -->
				<div class="card-content padding-6">

					<div class="row">
						<h3 class="card-title white-text">
							<i class="material-symbols-outlined left">place</i>
							Endereço
						</h3>
					</div>

					<!-- BEGIN Endereço/Número -->
					<div class="row">

						<!-- BEGIN Endereço -->
						<div class="col s8 pl-0">
							<div class="input-field">
								<label class="">Endereço</label>
								<input type="text" name="address" id="address" value="{{ config('site.address') }}">
							</div>
						</div>
						<!-- END Endereço -->

						<!-- BEGIN Número -->
						<div class="col s4 pr-0">
							<div class="input-field">
								<label class="">Número</label>
								<input type="text" name="address_nro" id="address_nro" value="{{ config('site.address_nro') }}">
							</div>
						</div>
						<!-- END Número -->

					</div>
					<!-- END Endereço/Número -->

					<!-- BEGIN CEP/Complemento -->
					<div class="row">

						<!-- BEGIN CEP -->
						<div class="col s4 pl-0">
							<div class="input-field">
								<label class="">CEP</label>
								<input type="text" name="cep" id="cep" class="box_input is_cep" value="{{ config('site.cep') }}">
							</div>
						</div>
						<!-- END CEP -->

						<!-- BEGIN Complemento -->
						<div class="col s8 pl-3 pr-0">
							<div class="input-field">
								<label class="">Complemento</label>
								<input type="text" name="complemento" id="complemento" value="{{ config('site.complemento') }}">
							</div>
						</div>
						<!-- END Complemento -->

					</div>
					<!-- END CEP/Complemento -->

					<!-- BEGIN Bairro / Cidade / UF -->
					<div class="row">

						<!-- BEGIN Bairro -->
						<div class="col s4 pl-0">
							<div class="input-field">
								<label class="">Bairro</label>
								<input type="text" name="bairro" id="bairro" value="{{ config('site.bairro') }}">
							</div>
						</div>
						<!-- END Bairro -->

						<!-- BEGIN Cidade -->
						<div class="col s5">
							<div class="input-field">
								<label class="">Cidade</label>
								<input type="text" name="cidade" id="cidade" value="{{ config('site.cidade') }}">
							</div>
						</div>
						<!-- END Cidade -->

						<!-- BEGIN UF -->
						<div class="col s1 pr-0">
							<div class="input-field">
								<label class="">UF</label>
								<input type="text" name="uf" id="uf" value="{{ config('site.uf') }}" maxlength="2">
							</div>
						</div>
						<!-- END UF -->

						<!-- BEGIN PAÍS -->
						<div class="col s2 pr-0">
							<div class="input-field">
								<label class="">País</label>
								<input type="text" name="pais" id="pais" value="{{ config('site.pais') }}">
							</div>
						</div>
						<!-- END PAÍS -->

					</div>
					<!-- END Bairro / Cidade / UF -->

					<!-- BEGIN Maps -->
					<div class="row">

						<!-- Maps -->
						<div class="col s11 pl-0">
							<div class="input-field">
								<label class="">Mapa</label>
								<input type="text" name="gmaps" id="gmaps" value="{{ config('site.gmaps') }}">
							</div>
						</div>
						<!-- END Maps -->

						<div class="col s1 mt-2">
							<button type="button" id="preview" class="btn btn-floating padding-4 waves-effect activator" data-tooltip="Ver o mapa" disabled="disabled">
								<i class="material-symbols-outlined ">more_vert</i>
							</button>
						</div>

					</div>
					<!-- END Maps -->

				</div>
				<!-- END card-content -->

				<div class="card-reveal">
					<button type="button" class="btn btn-floating card-title  text-darken-4 waves-effect waves-light">
						<i class="material-symbols-outlined">close</i>
					</button>
					<div id="iframe"></div>
				</div>

			</div>
			<!-- END card -->

		</div>
		<!-- END col s12 -->

	</div>
	<!-- END col.l6.s12 -->

</div>
<!-- END card informações -->
