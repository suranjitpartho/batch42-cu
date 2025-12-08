<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Batch24-CU') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=barlow:400,500,600|anek-bangla:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/frontend/app.css', 'resources/css/components/main.css', 'resources/js/app.js'])

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    </head>
    <body class="antialiased" x-data="{ open: false }" @keydown.window.escape="open = false">
        <x-topbar-loader />


        <header class="header">
            <div class="header-content">
                <div class="header-left">
                    <a href="{{ route('home') }}" class="header-logo-link">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo" class="header-logo">
                        <span class="header-app-name">{{ config('app.name') }}</span>
                    </a>
                </div>

                <div class="header-right">
                    <!-- Desktop Nav -->
                    <div class="desktop-nav">
                        <nav class="main-nav">
                            <ul class="nav-links">
                                <li class="nav-link"><a href="{{ route('home') }}">Home</a></li>
                                <li class="nav-link"><a href="{{ route('constitution.index') }}">Constitution</a></li>
                                <li class="nav-link"><a href="{{ route('events.index') }}">Events</a></li>
                                <li class="nav-link"><a href="{{ route('notices.index') }}">Notices</a></li>

                                <li class="nav-dropdown">
                                    <x-dropdown align="right">
                                        <x-slot name="trigger">
                                            <button class="nav-dropdown-button">
                                                <span>Alumni</span>
                                                <i class="fa-solid fa-chevron-down fa-xs"></i>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content" width="w-52">
                                            @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->alumniMembership?->status === 'approved'))
                                                <a href="{{ route('alumni.index') }}">Alumni Directory</a>
                                            @endif
                                            <a href="{{ route('membership.create') }}">Apply for Membership</a>
                                        </x-slot>
                                    </x-dropdown>
                                </li>
                            </ul>
                        </nav>

                        <div class="header-icons">
                            <div class="nav-dropdown">
                                <x-dropdown align="right">
                                    <x-slot name="trigger">
                                        <button class="nav-dropdown-button">
                                            @auth
                                                <span>{{ Auth::user()->name }}</span>
                                            @else
                                                <span>User</span>
                                            @endauth
                                            <i class="fa-solid fa-chevron-down fa-xs"></i>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content" width="w-52">
                                        @guest
                                            <a href="{{ route('login') }}">Login</a>
                                            <a href="{{ route('register') }}">Register</a>
                                        @else
                                            <div class="dropdown-header">
                                                Signed in as<br>
                                                <strong>{{ Auth::user()->name }}</strong>
                                            </div>
                                            <a href="{{ route('profile.edit') }}">Update Profile</a>
                                            @can('admin_panel-view')
                                                <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                                            @endcan
                                            <div class="dropdown-divider"></div>
                                            <form method="POST" action="{{ route('logout') }}" x-ref="logoutForm">
                                                @csrf
                                                <a href="{{ route('logout') }}" @click.prevent="$refs.logoutForm.submit();">
                                                    Log Out
                                                </a>
                                            </form>
                                        @endguest
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="hamburger-menu">
                        <button @click="open = !open" class="hamburger-button">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Mobile Nav -->
        <div class="mobile-nav-container" x-show="open" x-transition>
            <nav class="main-nav">
                <ul class="nav-links">
                    <li class="nav-link"><a href="{{ route('home') }}">Home</a></li>
                    <li class="nav-link"><a href="{{ route('constitution.index') }}">Constitution</a></li>
                    <li class="nav-link"><a href="{{ route('events.index') }}">Events</a></li>
                    <li class="nav-link"><a href="{{ route('notices.index') }}">Notices</a></li>

                    <li class="nav-dropdown">
                        <x-dropdown align="left">
                            <x-slot name="trigger">
                                <button class="nav-dropdown-button">
                                    <span>Alumni</span>
                                    <i class="fa-solid fa-chevron-down fa-xs"></i>
                                </button>
                            </x-slot>

                            <x-slot name="content" width="w-52">
                                @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->alumniMembership?->status === 'approved'))
                                    <a href="{{ route('alumni.index') }}">Alumni Directory</a>
                                @endif
                                <a href="{{ route('membership.create') }}">Apply for Membership</a>
                            </x-slot>
                        </x-dropdown>
                    </li>
                    <li class="nav-dropdown">
                        <x-dropdown align="right">
                            <x-slot name="trigger">
                                <button class="nav-dropdown-button">
                                    @auth
                                        <span>{{ Auth::user()->name }}</span>
                                    @else
                                        <span>User</span>
                                    @endauth
                                    <i class="fa-solid fa-chevron-down fa-xs"></i>
                                </button>
                            </x-slot>

                            <x-slot name="content" width="w-52">
                                @guest
                                    <a href="{{ route('login') }}">Login</a>
                                    <a href="{{ route('register') }}">Register</a>
                                @else
                                    <a href="{{ route('profile.edit') }}">Update Profile</a>
                                    @can('admin_panel-view')
                                        <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                                    @endcan
                                    <form method="POST" action="{{ route('logout') }}" x-ref="logoutForm">
                                        @csrf
                                        <a href="{{ route('logout') }}" @click.prevent="$refs.logoutForm.submit();">
                                            Log Out
                                        </a>
                                    </form>
                                @endguest
                            </x-slot>
                        </x-dropdown>
                    </li>
                </ul>
            </nav>
        </div>

        @if (!request()->routeIs('home') && count(Breadcrumbs::generate()))
            <div class="front-breadcrumb-container">
                {{ Breadcrumbs::render() }}
            </div>
        @endif

        <main id="main-content">
            @yield('content')
        </main>

        <footer class="footer">
            <div class="footer-content">
                <div class="footer-section about">
                    <h3 class="logo">{{ config('app.name', 'Laravel') }}</h3>
                    <p>
                        A shared space for memories, updates, and lifelong bonds.
                    </p>
                    <div class="social-icons">
                        <a href="{{ $socialLinks['facebook_url'] ?? '#' }}" @if(!empty($socialLinks['facebook_url'])) target="_blank" rel="noopener noreferrer" @endif><i class="fab fa-facebook"></i></a>
                        <a href="{{ $socialLinks['twitter_url'] ?? '#' }}" @if(!empty($socialLinks['twitter_url'])) target="_blank" rel="noopener noreferrer" @endif><i class="fab fa-twitter"></i></a>
                        <a href="{{ $socialLinks['instagram_url'] ?? '#' }}" @if(!empty($socialLinks['instagram_url'])) target="_blank" rel="noopener noreferrer" @endif><i class="fab fa-instagram"></i></a>
                        <a href="{{ $socialLinks['linkedin_url'] ?? '#' }}" @if(!empty($socialLinks['linkedin_url'])) target="_blank" rel="noopener noreferrer" @endif><i class="fab fa-linkedin"></i></a>
                        <a href="{{ $socialLinks['youtube_url'] ?? '#' }}" @if(!empty($socialLinks['youtube_url'])) target="_blank" rel="noopener noreferrer" @endif><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="footer-section footer-links">
                    <h3>Useful Links</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('constitution.index') }}">Constitution</a></li>
                        <li><a href="{{ route('content_pages.show', 'about-us') }}">About Us</a></li>
                    </ul>
                </div>

                <div class="footer-section footer-links">
                    <h3>Help</h3>
                    <ul>
                        <li><a href="{{ route('content_pages.show', 'faq') }}">FAQ</a></li>
                        <li><a href="{{ route('content_pages.show', 'privacy-policy') }}">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Subscribe</h3>
                    <p>Get the latest updates and offers.</p>
                    <form action="#" class="subscribe-form">
                        <input type="email" name="email" placeholder="Your email address" class="subscribe-input">
                        <button type="submit" class="subscribe-button">Subscribe</button>
                    </form>
                </div>
            </div>
            <x-advertisements.footer />
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Batch42_CU') }}. All rights reserved.</p>
            </div>
        </footer>

        <x-toast/>

        <x-advertisements.lightbox />
        <x-advertisements.promo-popup />
    </body>
</html>
