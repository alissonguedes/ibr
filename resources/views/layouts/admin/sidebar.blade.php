<x-slot:sidebar class="sidenav-dark sidenav-active-rounded">

	{{-- <div id="slide-out" class="sidenav sidenav-fixed sidenav-collapsible leftside-navigation menu-shadow" data-menu="menu-navigation" data-collapsible="accordion"> --}}

	<button type="button" class="btn-menu btn-floating waves-effect z-depth-0 hide-on-med-and-down">
		<i class="material-symbols-outlined">menu</i>
	</button>

	{{--
		<button class="btn btn-flat btn-floating sidenav-close waves-effect mr-3 hide-on-large-only">
			<i class="material-symbols-outlined grey-text text-darken-4">close</i>
		</button> --}}
	{{-- <a href="#mmenu" class="btn-menu btn-floating waves-effect z-depth-0">
		<i class="material-symbols-outlined">menu</i>
	</a> --}}

	<div class="main-menu">
		@include('admin.navigation')
	</div>

	{{-- </div> --}}

</x-slot:sidebar>
