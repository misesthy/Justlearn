@props(['active'])

@php
$classes = ($active)
            ? 'menu-link'
            : 'menu-link active';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
