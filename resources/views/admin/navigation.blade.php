<div id="mmenu" class="animated fadeIn">

	<ul>
		<li><x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"> <i class="material-symbols-outlined">dashboard</i> {{ __('Dashboard') }}</x-nav-link></li>
		<li><x-nav-link :href="route('admin.categorias.index')" :active="request()->routeIs('admin.categorias.index')"> <i class="material-symbols-outlined">category</i> {{ __('Categorias') }}</x-nav-link></li>
		<li><x-nav-link :href="route('admin.usuarios.index')" :active="request()->routeIs('admin.usuarios.index')"> <i class="material-symbols-outlined">group</i> {{ __('Usuários') }}</x-nav-link></li>
		<li>
			<x-nav-link href="javascript:void(0);" class="submenu-open" data-id="#paginas"> <i class="material-symbols-outlined">home</i> Páginas </x-nav-link>
			<ul id="paginas" class="{{ request()->routeIs('admin.paginas.a-ibr.index') || request()->routeIs('admin.paginas.ministerios.index') || request()->routeIs('admin.paginas.cultos.index') || request()->routeIs('admin.paginas.cultos.edit') || request()->routeIs('admin.paginas.eventos.index') || request()->routeIs('admin.paginas.eventos.edit') || request()->routeIs('admin.paginas.eventos.inscritos') ? 'in' : 'submenu' }} scroller">
				<li>
					<x-nav-link href="javascript:void(0);" class="submenu-open" data-id="#home-page">
						<i class="material-symbols-outlined">home</i> Página Inicial
					</x-nav-link>
					<ul id="home-page" class="{{ request()->routeIs('admin.paginas.home.banners.index') || request()->routeIs('admin.paginas.home.banners.edit') || request()->routeIs('admin.paginas.home.apresentacao.index') || request()->routeIs('admin.paginas.home.pastores.index') || request()->routeIs('admin.paginas.home.pastores.edit') ? 'in' : 'submenu' }} scroller">
						<li>
							<x-nav-link :href="route('admin.paginas.home.banners.index')" :active="request()->routeIs('admin.paginas.home.banners.index') || request()->routeIs('admin.paginas.home.banners.edit')">
								<i class="material-symbols-outlined">wallpaper_slideshow</i>
								banners
							</x-nav-link>
						</li>
						<li>
							<x-nav-link :href="route('admin.paginas.home.apresentacao.index')" :active="request()->routeIs('admin.paginas.home.apresentacao.index')">
								<i class="material-symbols-outlined">face</i>
								Apresentação
							</x-nav-link>
						</li>
						<li>
							<x-nav-link :href="route('admin.paginas.home.pastores.index')" :active="request()->routeIs('admin.paginas.home.pastores.index') || request()->routeIs('admin.paginas.ministerios.edit')">
								<i class="material-symbols-outlined">group</i>
								Corpo Pastoral
							</x-nav-link>
						</li>
						<li>
							<x-nav-link :href="route('admin.paginas.home.propositos.index')" :active="request()->routeIs('admin.paginas.home.propositos.index') || request()->routeIs('admin.paginas.home.propositos.edit')">
								<i class="material-symbols-outlined">volunteer_activism</i>
								Propósitos
							</x-nav-link>
						</li>
					</ul>

				</li>
				<li><x-nav-link :href="route('admin.paginas.a-ibr.index')" :active="request()->routeIs('admin.paginas.a-ibr.index')"> <i class="material-symbols-outlined">church</i> A IBR</x-nav-link> </li>
				<li><x-nav-link :href="route('admin.paginas.ministerios.index')" :active="request()->routeIs('admin.paginas.ministerios.index') || request()->routeIs('admin.paginas.ministerios.edit')"> <i class="material-symbols-outlined">groups</i> Ministérios</x-nav-link></li>
				<li><x-nav-link :href="route('admin.paginas.cultos.index')" :active="request()->routeIs('admin.paginas.cultos.index') || request()->routeIs('admin.paginas.cultos.edit')"> <i class="material-symbols-outlined">diversity_3</i> Cultos </x-nav-link> </li>
				<li><x-nav-link :href="route('admin.paginas.eventos.index')" :active="request()->routeIs('admin.paginas.eventos.index') || request()->routeIs('admin.paginas.eventos.edit') || request()->routeIs('admin.paginas.eventos.inscritos')"> <i class="material-symbols-outlined">event</i> Eventos </x-nav-link></li>
				<li><x-nav-link :href="route('admin.paginas.agenda.index')" :active="request()->routeIs('admin.paginas.agenda.index') || request()->routeIs('admin.paginas.agenda.edit') || request()->routeIs('admin.paginas.agenda.inscritos')"> <i class="material-symbols-outlined">contacts</i> Agenda </x-nav-link></li>
			</ul>
		</li>
	</ul>

</div>
