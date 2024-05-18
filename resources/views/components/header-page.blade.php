@props(['search'])
@php
	$attr = $attributes->getAttributes();
	$placeholder = $attr['placeholder'] ?? null;
	$url = $attr['url'] ?? null;
	$btn_title = $attr['title'] ?? null;
	$trigger = $attr['data-trigger'] ?? null;
@endphp

<x-slot:header>
	<div id="search-on-page">
		<button id="open-search" class="btn btn-floating btn-flat mr-3 waves-effect waves-purple white-text">
			<i class="material-symbols-outlined">search</i>
		</button>
		<x-text-input type="search" id="input-search-header" :data-url="$url" :placeholder="$placeholder" autocomplete="off" />
	</div>
	<x-button id="card-button" {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-floating waves-effect']) }} :title="$btn_title" :data-trigger="$trigger">
		{{ $slot }}
	</x-button>
</x-slot:header>
