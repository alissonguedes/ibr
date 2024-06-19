<x-nav-link class="waves-cyan" :href="route('site.home.index')" :active="request()->routeIs('site.home.index')">
	<div class="lk">HOME</div>
</x-nav-link>

<x-nav-link :href="route('site.home.a-ibr')" class="waves-cyan" :active="request()->routeIs('site.home.a-ibr')">
	<div class="lk">A IBR</div>
</x-nav-link>

<x-nav-link :href="route('site.ministerios')" class="waves-cyan" :active="request()->routeIs('site.ministerios')">
	<div class="lk">Ministérios</div>
</x-nav-link>

<x-nav-link :href="route('site.cultos')" class="waves-cyan" :active="request()->routeIs('site.cultos')">
	<div class="lk">Cultos</div>
</x-nav-link>

<x-nav-link :href="route('site.eventos')" class="waves-cyan" :active="request()->routeIs('site.eventos')">
	<div class="lk">Eventos</div>
</x-nav-link>

<x-nav-link :href="route('site.agenda')" class="waves-cyan" :active="request()->routeIs('site.agenda')">
	<div class="lk">Agenda</div>
</x-nav-link>

<x-nav-link :href="route('site.seja-membro')" class="waves-cyan" :active="request()->routeIs('site.seja-membro')">
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
