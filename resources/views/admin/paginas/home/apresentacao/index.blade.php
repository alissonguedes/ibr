<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.paginas.home.apresentacao.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Apresentação </x-slot:title>

	<x-slot:main>

		@include('admin.paginas.home.apresentacao.includes.form')

	</x-slot:main>

	@pushOnce('scripts')
		<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
		<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>
	@endPushOnce

</x-admin-layout>
