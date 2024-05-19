<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.home.nossa-crenca.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Nossa Crença </x-slot:title>

	<x-slot:main>

		@include('admin.home.nossa-crenca.includes.form')

	</x-slot:main>

	<x-slot:script>
		{{-- <script>
			$('.materialboxed').materialbox();
		</script> --}}
		<x-modal id="form_plano_saude">
			Teasdfste
		</x-modal>
	</x-slot:script>

</x-admin-layout>
