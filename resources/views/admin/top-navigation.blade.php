<nav class="top-nav">
    <div class="top-nav-container">
        <div class="top-nav-left">
            <!-- Hamburger -->
            <button @click="$dispatch('toggle-sidebar')" class="hamburger-button">
                <svg class="hamburger-icon" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            @isset($header)
                <div class="top-nav-header">
                    {{ $header }}
                </div>
            @endisset
        </div>

        <!-- Settings Dropdown -->
        <div class="top-nav-right">
            <a href="{{ route('home') }}" class="top-nav-button" title="Storefront">
                <svg class="topbar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" />
                </svg>
            </a>
            <x-dropdown class="user-dropdown-container">
                <x-slot name="trigger">
                    <button class="top-nav-button" title="User">
                        <svg class="topbar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="dropdown-user-info">
                        <div class="dropdown-user-name">{{ Auth::user()->name }}</div>
                        <div class="dropdown-user-email">{{ Auth::user()->email }}</div>
                    </div>
                    <hr class="dropdown-divider">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>
