@extends('clinica-v2.body')

{{-- @section('styles')
    @parent
@endsection --}}

{{-- @section('scripts')
    @parent
@endsection --}}
@section('title', 'Home')
@section('icon', 'home')

@section('content')
	@include('clinica-v2.header')
	@include('clinica-v2.sidebar')

	<div id="page">

		<div class="row">

			<div class="col s12 l6 offset-l3">

				<div class="container">

					<div class="row">
						<div class="col s12">
							@var($homepage = true)
							@include('clinica-v2.main-menu')
						</div>
					</div>

					<div id="menu-home">

						<div class="row mt-3 mb-3">
							<div class="col s12">
								<button class="btn btn-large col s12 m6 l6 offset-m3 offset-l3 border-radius-20 waves-effect"
									style="background-color: rgba(0, 0, 0, 0.2);">
									<span class="uppercase">Tickets</span>
								</button>
							</div>
						</div>

						<div class="row">

							<div class="col s12">

								<div class="row">
									<div class="col s12">
										<h3 class="menu-description white-text center-align mt-2 mb-">Gerenciamento</h3>
									</div>
								</div>

								<div class="row">
									<div class="col s6">
										<button class="btn btn-large col border-radius-20 waves-effect" style="background-color: rgba(0, 0, 0, 0.2);">
											<span class="uppercase">Cadastros</span>
										</button>
									</div>

									<div class="col s6">
										<button class="btn btn-large col border-radius-20 waves-effect" style="background-color: rgba(0, 0, 0, 0.2);">
											<span class="uppercase">Tabelas</span>
										</button>
									</div>
								</div>

							</div>

						</div>

					</div>

				</div>

			</div>
		</div>
	</div>

	@include('clinica-v2.footer')
@endsection
