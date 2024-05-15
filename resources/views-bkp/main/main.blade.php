@extends('layout.body')

@section('styles')
	@parent
	@include('main.defaults.__styles')
@endsection

@section('scripts')
	@parent
	@include('main.defaults.__scripts')
@endsection

@section('content')
	@include('main.defaults.loading')

	<!-- #corpo -->
	<div id="corpo" class="corpo">
		@include('main.defaults.topo')
		@parent
		@include('main.defaults.footer')
	</div>
	<!-- END #corpo -->
@endsection
