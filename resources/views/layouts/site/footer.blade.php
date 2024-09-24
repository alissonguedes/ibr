@php

	$config = new App\Models\ConfigModel();

	config($config->getAllConf());

@endphp

<!--footer-->
<footer>
	<div class="content">

		<div class="logo_f"><img src="{{ asset('assets/img/logo_completa_branca.png') }}" class="img_cem"></div>
		<div class="endereco_fone">
			<div class="title_footer">Endereço</div>
			<div class="text_footer">
				{{ config('site.address') }}, {{ config('site.address_nro') }}<br>
				{{ config('site.bairro') }}, {{ config('site.cidade') }} - {{ config('site.uf') }} - {{ config('site.cep') }}
			</div>
			<a href="tel:+55{{ config('site.contact_phone') }}">
				<div class="title_footer">{{ config('site.contact_phone') }}</div>
			</a>
		</div>
		<div class="social_footer">
			<a href="{{ config('site.youtube') }}" target="_blank">
				<div class="icotop"><img src="{{ asset('assets/img/ico_youtube.png') }}" class="img_cem"></div>
			</a>
			<a href="{{ config('site.instagram') }}" target="_blank">
				<div class="icotop"><img src="{{ asset('assets/img/ico_insta1.png') }}" class="img_cem"></div>
			</a>
			<a href="https://wa.me/55{{ config('site.contact_cel') }}" target="_blank">
				<div class="icotop"><img src="{{ asset('assets/img/ico_whats1.png') }}" class="img_cem"></div>
			</a>
			<div id="bt_local" class="icotop" data-element=".boxlocal"><img src="{{ asset('assets/img/ico_local1.png') }}" class="img_cem"></div>
		</div>
	</div>
	<div class="copyright_dev">
		<div class="content">

			<div class="copyright">{{ config('site.site_title') }} <?php echo date('Y'); ?>. Todos os direitos
				reservados.</div>
			<div class="dev">

				<a href="https://wa.me/5583988336804" target="_blank">
					<div class="logo_dev2">
						<img src="{{ asset('assets/img/fstrong.png') }}" class="img_cem">
					</div>
				</a>
			</div>

		</div>
	</div>
</footer>
