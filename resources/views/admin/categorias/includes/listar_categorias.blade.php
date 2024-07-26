@foreach ($categorias as $categoria)
	<ol class="dd-list">
		<li class="dd-item" data-id="{{ $categoria->id }}">
			{{-- <div class="dd-handle"></div> --}}
			<div class="dd-content">
				{{ $categoria->titulo }}

				@can('update', App\Models\Admin\CategoriaModel::class)
					<button type="button" class="icon-background edit btn btn-small btn-floating waves-effect right gradient-45deg-green-light-green" data-href="{{ route('admin.categorias.edit', $categoria->id) }}">
						<i class="material-symbols-outlined">edit</i>
					</button>
				@endcan

				{{-- <form action="{{ route('admin.categorias.delete') }}" method="post">
					@csrf
					<input type="hidden" name="_method" value="delete">
					<button type="submit">Remover</button>
				</form> --}}
			</div>
			@php
				$categorias = new App\Models\Admin\CategoriaModel();
				$parent['categorias'] = $categorias
				    ->select('id', 'titulo')
				    ->from('tb_categoria')
				    ->whereNotNull('id_parent')
				    ->where('id_parent', $categoria->id)
				    ->orderBy('titulo', 'asc')
				    ->get();
			@endphp
			@if ($parent['categorias']->count())
				{{ view('admin.categorias.includes.listar_categorias', $parent) }}
			@endif
		</li>
	</ol>
@endforeach

{{--
<div class="dd">
<ol class="dd-list">
<li class="dd-item" data-id="13">
<div class="dd-handle"></div>
<div class="dd-content">Item 13
<button type="button" class="btn btn-small btn-floating edit waves-effect right">
<i class="material-symbols-outlined">edit</i>
</button>
</div>
</li>
<li class="dd-item" data-id="14">
<div class="dd-handle"></div>
<div class="dd-content">Item 14
<button type="button" class="btn btn-small btn-floating edit waves-effect right">
<i class="material-symbols-outlined">edit</i>
</button>
</div>
</li>
<li class="dd-item" data-id="15">
<div class="dd-handle"></div>
<div class="dd-content">Item 15
<button type="button" class="btn btn-small btn-floating edit waves-effect right">
<i class="material-symbols-outlined">edit</i>
</button>
</div>
<ol class="dd-list">
<li class="dd-item" data-id="16">
<div class="dd-handle"></div>
<div class="dd-content">Item 16
<button type="button" class="btn btn-small btn-floating edit waves-effect right">
<i class="material-symbols-outlined">edit</i>
</button>
</div>
</li>
<li class="dd-item" data-id="17">
<div class="dd-handle"></div>
<div class="dd-content">Item 17
<button type="button" class="btn btn-small btn-floating edit waves-effect right">
<i class="material-symbols-outlined">edit</i>
</button>
</div>
</li>
<li class="dd-item" data-id="18">
<div class="dd-handle"></div>
<div class="dd-content">Item 18
<button type="button" class="btn btn-small btn-floating edit waves-effect right">
<i class="material-symbols-outlined">edit</i>
</button>
</div>
</li>
</ol>
</li>
</ol>
</div> --}}
