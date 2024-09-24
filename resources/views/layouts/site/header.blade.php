@php

	$config = new App\Models\ConfigModel();

	config($config->getAllConf());

@endphp

<!--menu-->
<section class="topo">
	<div class="logo"><img src="{{ asset('assets/img/logo1.png') }}" class="img_cem"></div>
	<div class="logo2"><img src="{{ asset('assets/img/logo2.png') }}" class="img_cem"></div>
	<div class="menu">
		@include('main.navigation')
	</div>
	<div class="socialtop">
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
	<div id="bt_mob" class="bt_menu_mob" data-element=".menu"><img src="{{ asset('assets/img/bt_mob.png') }}" class="img_cem">
	</div>
</section>

<!--ABA HORÁRIOS-->
<div class="aba_h">
	<div class="aba">
		<img src="{{ asset('assets/img/abah.png') }}" class="img_cem">
	</div>
	<div class="cont_aba">

		<div class="conj_h">
			<div class="dia_semana">Segunda-feira</div>
			<div class="horario">19h30</div>
			<div class="conteudo_h">Culto de Oração</div>
		</div>

		<div class="conj_h">
			<div class="dia_semana">Quarta-feira</div>
			<div class="horario">19h30</div>
			<div class="conteudo_h">Culto de Oração</div>
		</div>

		<div class="conj_h">
			<div class="dia_semana">Sábado</div>
			<div class="horario">19h30</div>
			<div class="conteudo_h">Culto de Oração</div>
		</div>

		<div class="conj_h">
			<div class="dia_semana">Domingo</div>
			<div class="horario">19h30</div>
			<div class="conteudo_h">Culto de Oração</div>
		</div>

	</div>
</div>
