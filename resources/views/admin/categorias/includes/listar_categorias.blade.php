{{-- @if (isset($categorias) && $categorias->count() > 0)
	<div class="dd">
		<ol class="dd-list">
			@foreach ($categorias as $categoria)
				<li class="dd-item" data-id="1">
					<div class="dd-handle">{{ $categoria->titulo }}</div>

				</li>
			@endforeach
		</ol>
	</div>
@else
	<div class="row">
		<div class="col s12">
			Nenhum categoria cadastrado.
		</div>
	</div>
@endif --}}

<div class="dd">
	<ol class="dd-list">
		<li class="dd-item" data-id="13">
			<div class="dd-handle"></div>
			<div class="dd-content">Item 13</div>
		</li>
		<li class="dd-item" data-id="14">
			<div class="dd-handle"></div>
			<div class="dd-content">Item 14</div>
		</li>
		<li class="dd-item" data-id="15">
			<div class="dd-handle"></div>
			<div class="dd-content">Item 15</div>
			<ol class="dd-list">
				<li class="dd-item" data-id="16">
					<div class="dd-handle"></div>
					<div class="dd-content">Item 16</div>
				</li>
				<li class="dd-item" data-id="17">
					<div class="dd-handle"></div>
					<div class="dd-content">Item 17</div>
				</li>
				<li class="dd-item" data-id="18">
					<div class="dd-handle"></div>
					<div class="dd-content">Item 18</div>
				</li>
			</ol>
		</li>
	</ol>
</div>
