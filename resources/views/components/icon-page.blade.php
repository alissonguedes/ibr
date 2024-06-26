@php
	$classes = 'btn btn-flat btn-small btn-floating material-symbols-outlined';
	$is_icon = in_array('data-href', array_keys($attributes->getAttributes())) || in_array('href', array_keys($attributes->getAttributes()));
@endphp

@if (!$is_icon)
	<span class="icon material-symbols-outlined">{{ $slot }}</span>
@else
	<button {{ $attributes->merge(['type' => 'button', 'class' => implode(' ', [$classes, 'waves-effect waves-green material-symbols-outlined'])]) }}>
		arrow_back
	</button>
@endif
