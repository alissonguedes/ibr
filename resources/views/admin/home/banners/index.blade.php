<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.home.banners.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Banners </x-slot:title>

	<x-slot:body>

		<div class="row">
			@for ($i = 0; $i < 10; $i++)
				<div class="col s4">
					<div class="card transparent">
						<div class="card-image">
							<img src="https://materializecss.com/images/sample-1.jpg" height="150">
							<span class="card-title">Card Title</span>
						</div>
						<div class="card-content ">
							{{-- <p>
								I am a very simple card. I am good at containing small bits of information.
								I am convenient because I require little markup to use effectively.</p> --}}
						</div>
						<div class="card-action black right-align">
							<x-button class="gradient-45deg-green-light-green black-text btn-small mr-3"> add </x-button>
							<x-button class="gradient-45deg-green-light-green black-text btn-small" :data-href="route('admin.home.banners.edit', 1)"> edit </x-button>
						</div>
					</div>
				</div>
			@endfor
		</div>

	</x-slot:body>

	@include('admin.home.banners.includes.form')

	<x-slot:script>
		<x-modal id="form_plano_saude">
			Teasdfste
		</x-modal>
	</x-slot:script>

</x-admin-layout>
