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
		@props(['dias_semana' => ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado']])
		@php
			$agenda_cultos = new App\Models\Admin\AgendaModel();
			$cultos = $agenda_cultos->where('tipo', 'culto')->get();
		@endphp

		@if (isset($cultos) && $cultos->count() > 0)
			@php
				$dias = [];
				$horarios = [];
			@endphp
			@foreach ($cultos as $culto)
				@php
					$horarios = json_decode($culto->horarios, true);
				@endphp
				@foreach ($horarios as $dia => $hora)
					@foreach ($hora as $h)
						@php
							$dias[$dia][] = [
							    'titulo' => $culto->titulo,
							    'inicio' => date('H\hi', strtotime($h['inicio'])),
							    'fim' => date('H\hi', strtotime($h['fim'])),
							];
						@endphp
					@endforeach
				@endforeach
			@endforeach
			@php
				ksort($dias);
			@endphp
			@foreach ($dias as $dia => $hora)
				<div class="conj_h">
					<div class="dia_semana">{{ $dias_semana[$dia] }}</div>
					@foreach ($hora as $h)
						<div class="horario">{{ $h['inicio'] }}</div>
						<div class="conteudo_h">{{ $h['titulo'] }}</div>
					@endforeach
				</div>
			@endforeach
		@endif

	</div>
</div>
