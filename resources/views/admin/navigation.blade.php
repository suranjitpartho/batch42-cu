<nav class="sidebar-nav" x-bind:class="{ 'overflow-hidden': !sidebarOpen }">
    <!-- Logo -->
    <div class="sidebar-logo-container">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo" class="sidebar-logo" />
            <span class="sidebar-logo-text" x-show="sidebarOpen">{{ config('app.name') }}</span>
        </a>
        {{-- Close button for mobile sidebar --}}
        <button type="button" @click="$dispatch('toggle-sidebar')" class="mobile-sidebar-close-button" x-show="sidebarOpen && window.innerWidth <= 768">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Navigation Links -->
    <div class="sidebar-nav-links">
        @can('admin_panel-view')
            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" icon="fa-solid fa-gauge-high">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-group name="{{ __('Settings') }}" :active="request()->routeIs('admin.users.index') || request()->routeIs('admin.roles.index')" icon="fa-solid fa-gear">
                <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')" icon="fa-solid fa-users">
                    {{ __('Users') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.roles.index')" :active="request()->routeIs('admin.roles.index')" icon="fa-solid fa-user-gear">
                    {{ __('Roles') }}
                </x-nav-link>
            </x-nav-group>

            <x-nav-group name="{{ __('Contents') }}" :active="request()->routeIs('admin.hero-banners.index') || request()->routeIs('admin.events.index') || request()->routeIs('admin.memberships.index') || request()->routeIs('admin.notices.index') || request()->routeIs('admin.university-info.edit') || request()->routeIs('admin.content-pages.index') || request()->routeIs('admin.advertisements.index') || request()->routeIs('admin.constitutions.index') || request()->routeIs('admin.video-galleries.index')" icon="fa-solid fa-globe">
                <x-nav-link :href="route('admin.hero-banners.index')" :active="request()->routeIs('admin.hero-banners.index')" icon="fa-solid fa-images">
                    {{ __('Banners') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.index')" icon="fa-solid fa-calendar-days">
                    {{ __('Events') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.memberships.index')" :active="request()->routeIs('admin.memberships.index')" icon="fa-solid fa-user-check">
                    {{ __('Memberships') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.notices.index')" :active="request()->routeIs('admin.notices.index')" icon="fa-solid fa-bell">
                    {{ __('Notices') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.university-info.edit')" :active="request()->routeIs('admin.university-info.edit')" icon="fa-solid fa-building-columns">
                    {{ __('University Info') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.content-pages.index')" :active="request()->routeIs('admin.content-pages.index')" icon="fa-solid fa-file-lines">
                    {{ __('Content Pages') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.advertisements.index')" :active="request()->routeIs('admin.advertisements.index')" icon="fa-solid fa-rectangle-ad">
                    {{ __('Advertisements') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.constitutions.index')" :active="request()->routeIs('admin.constitutions.index')" icon="fa-solid fa-book">
                    {{ __('Constitution') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.video-galleries.index')" :active="request()->routeIs('admin.video-galleries.index')" icon="fa-solid fa-video">
                    {{ __('Video Gallery') }}
                </x-nav-link>
            </x-nav-group>
        @endcan
    </div>

    <div class="sidebar-version" x-show="sidebarOpen">
        Version: {{ config('version.app') }}
    </div>
</nav>
