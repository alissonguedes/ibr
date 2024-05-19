<ul id="main-menu" class="{{ request()->routeIs('admin.dashboard') ? 'in' : null }} scroller">
	<li><x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">{{ __('Dashboard') }}</x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" class="submenu-open" data-id="#home-page" :active="request()->routeIs('admin.teste')"> <i class="material-symbols-outlined left">dashboard</i> Página Inicial </x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')"><i class="material-symbols-outlined left">event</i>Menu 4</x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" class="submenu-open" data-id="#menu-5" :active="request()->routeIs('admin.teste')">Menu 5 </x-nav-link></li>
</ul>

<ul id="home-page" class="{{ request()->routeIs('admin.home.banners.index') || request()->routeIs('admin.home.banners.edit') || request()->routeIs('admin.home.nossa-crenca.index') || request()->routeIs('admin.home.pastores') ? 'in' : 'submenu' }} scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#main-menu"> Página Inicial </x-nav-link></li>
	<li>
		<x-nav-link :href="route('admin.home.banners.index')" :active="request()->routeIs('admin.home.banners.index') || request()->routeIs('admin.home.banners.edit')">
			<i class="material-symbols-outlined">wallpaper_slideshow</i>
			Banners
		</x-nav-link>
	</li>
	<li>
		<x-nav-link :href="route('admin.home.nossa-crenca.index')" :active="request()->routeIs('admin.home.nossa-crenca.index')">
			<i class="material-symbols-outlined">wallpaper_slideshow</i>
			Nossa Crença
		</x-nav-link>
	</li>
	<li>
		<x-nav-link :href="route('admin.home.pastores')" :active="request()->routeIs('admin.home.pastores')">
			<i class="material-symbols-outlined">group</i>
			Corpo Pastoral
		</x-nav-link>
	</li>
</ul>

<ul id="menu-5" class="submenu scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#main-menu" :active="request()->routeIs('admin.teste')"> Menu 5</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 3</x-nav-link></li>
</ul>

<ul id="menu-6" class="submenu scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#home-page" :active="request()->routeIs('admin.teste')"> SubMenu 6</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 3</x-nav-link></li>
</ul>

<ul id="menu-7" class="submenu scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#home-page" :active="request()->routeIs('admin.teste')"> SubMenu 7</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 3</x-nav-link></li>
</ul>

<ul id="menu-8" class="submenu scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#home-page" :active="request()->routeIs('admin.teste')"> SubMenu 8</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" class="submenu-open" data-id="#menu-9" :active="request()->routeIs('admin.teste')">SubMenu 3 </x-nav-link></li>
</ul>

<ul id="menu-9" class="submenu scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#menu-8" :active="request()->routeIs('admin.teste')"> SubMenu 9</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" class="submenu-open" data-id="#menu-10" :active="request()->routeIs('admin.teste')">SubMenu 3 </x-nav-link></li>
</ul>

<ul id="menu-10" class="submenu scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#menu-9" :active="request()->routeIs('admin.teste')"> SubMenu 10</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
</ul>
