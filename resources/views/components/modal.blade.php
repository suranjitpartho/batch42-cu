@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidth = [
    'sm' => 'admin-modal-panel--sm',
    'md' => 'admin-modal-panel--md',
    'lg' => 'admin-modal-panel--lg',
    'xl' => 'admin-modal-panel--xl',
    '2xl' => 'admin-modal-panel--2xl',
][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            // All focusable element types...
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                // All non-disabled elements...
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('overflow-y-hidden');
        }
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="admin-modal-container"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div
        x-show="show"
        class="admin-modal-backdrop"
        x-on:click="show = false"
        x-transition:enter="admin-modal-transition-enter"
        x-transition:enter-start="admin-modal-transition-enter-start"
        x-transition:enter-end="admin-modal-transition-enter-end"
        x-transition:leave="admin-modal-transition-leave"
        x-transition:leave-start="admin-modal-transition-leave-start"
        x-transition:leave-end="admin-modal-transition-leave-end"
    >
        <div class="admin-modal-backdrop-overlay"></div>
    </div>

    <div
        x-show="show"
        class="admin-modal-panel {{ $maxWidth }}"
        x-transition:enter="admin-modal-panel-transition-enter"
        x-transition:enter-start="admin-modal-panel-transition-enter-start"
        x-transition:enter-end="admin-modal-panel-transition-enter-end"
        x-transition:leave="admin-modal-panel-transition-leave"
        x-transition:leave-start="admin-modal-panel-transition-leave-start"
        x-transition:leave-end="admin-modal-panel-transition-leave-end"
    >
        {{ $slot }}
    </div>
</div>
