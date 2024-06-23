<x-nav-link class="waves-cyan" :href="route('site.home.index')" :active="request()->routeIs('site.home.index')">
	<div class="lk">HOME</div>
</x-nav-link>

<x-nav-link class="waves-cyan" :href="route('site.home.a-ibr')" :active="request()->routeIs('site.home.a-ibr')">
	<div class="lk">A IBR</div>
</x-nav-link>

<x-nav-link class="waves-cyan" :href="route('site.ministerios')" :active="request()->routeIs('site.ministerios') || request()->routeIs('site.ministerios.details')">
	<div class="lk">Ministérios</div>
</x-nav-link>

<x-nav-link class="waves-cyan" :href="route('site.cultos')" :active="request()->routeIs('site.cultos') || request()->routeIs('site.cultos.details')">
	<div class="lk">Cultos</div>
</x-nav-link>

<x-nav-link class="waves-cyan" :href="route('site.eventos')" :active="request()->routeIs('site.eventos') || request()->routeIs('site.eventos.details')">
	<div class="lk">Eventos</div>
</x-nav-link>

<x-nav-link class="waves-cyan" :href="route('site.agenda')" :active="request()->routeIs('site.agenda')">
	<div class="lk">Agenda</div>
</x-nav-link>

<x-nav-link class="waves-cyan" :href="route('site.seja-membro')" :active="request()->routeIs('site.seja-membro')">
	<div class="lk_bt">SEJA MEMBRO</div>
</x-nav-link>

<style>
	.topo a .lk {
		position: relative;
	}

	.topo a.active .lk::after {
		content: '';
		position: absolute;
		left: 0;
		bottom: 0;
		height: 2px;
		width: 100%;
		background-image: linear-gradient(#c3c907, #c3c907), linear-gradient(#ccc, #ccc);
		display: none;
		opacity: 0;
		transition 2s;
	}

	.topo a.active .lk::after {
		display: block;
		opacity: 1;
	}
</style>
