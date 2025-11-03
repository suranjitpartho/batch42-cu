@props(['name', 'active' => false, 'icon' => null])

<div class="nav-group {{ $active ? 'nav-group-active' : '' }}">
    <div class="nav-group-header">
        <div class="nav-group-title-wrapper">
            @if($icon)
                <i class="{{ $icon }} nav-group-icon-fa"></i>
            @endif
            <span class="nav-group-title">{{ $name }}</span>
        </div>
        <svg class="nav-group-icon {{ $active ? 'rotate-90' : '' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
    </div>
    <div class="nav-group-links">
        {{ $slot }}
    </div>
</div>