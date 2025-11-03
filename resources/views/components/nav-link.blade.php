@props(['active', 'icon' => null])

@php
$classes = ($active ?? false)
            ? 'nav-link nav-link-active'
            : 'nav-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} @click="handleSidebarNav">
    @if($icon)
        <i class="{{ $icon }} nav-link-icon-fa"></i>
    @endif
    {{ $slot }}
</a>
