<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Batch24_CU') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=barlow:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/frontend/app.css', 'resources/css/components/main.css', 'resources/js/app.js'])

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    </head>
    <body class="antialiased">
        <x-topbar-loader />


        <header class="header">
            <div class="header-content">
                <div class="header-left">
                    <span class="open-btn" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hero-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </span>
                    <a href="{{ route('home') }}" class="header-logo-link">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo" class="header-logo">
                        <span class="header-app-name">{{ config('app.name') }}</span>
                    </a>
                </div>
                <div class="header-icons">
                    <div class="profile-dropdown">
                        <button class="profile-dropbtn" aria-label="Profile">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hero-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                        <div class="profile-dropdown-content">
                            @guest
                                <a href="{{ route('login') }}">Login</a>
                                <a href="{{ route('register') }}">Register</a>
                            @endguest
                            @auth
                                <div class="dropdown-header">
                                    Signed in as<br>
                                    <strong>{{ Auth::user()->name }}</strong>
                                </div>
                                <a href="{{ route('membership.create') }}">Membership</a>
                                <a href="{{ route('profile.edit') }}">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">Log Out</button>
                                </form>
                            @endauth
                        </div>
                    </div>

                    @if(Auth::check() && Auth::user()->can('admin_panel-view'))
                        <a href="{{ route('admin.dashboard') }}" aria-label="Admin Dashboard">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hero-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.24-8.25-3.286z" />
                            </svg>
                        </a>
                    @endif


                </div>
            </div>
        </header>



        <main id="main-content">
            @yield('content')
        </main>

        <footer class="footer">
            <div class="footer-content">
                <div class="footer-section about">
                    <h3 class="logo">{{ config('app.name', 'Laravel') }}</h3>
                    <p>
                        Your one-stop shop for the latest trends in fashion and accessories.
                    </p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>

                <div class="footer-section footer-links">
                    <h3>Useful Links</h3>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-section footer-links">
                    <h3>Help</h3>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Privacy Policy</a></li>
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
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Batch42_CU') }}. All rights reserved.</p>
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Dropdown
                const profileDropdown = document.querySelector('.profile-dropdown');
                if (profileDropdown) {
                    profileDropdown.addEventListener('click', function(event) {
                        this.classList.toggle('active');
                        event.stopPropagation();
                    });
                }

                document.addEventListener('click', (event) => {
                    // Dropdown
                    if (profileDropdown && !profileDropdown.contains(event.target)) {
                        profileDropdown.classList.remove('active');
                    }
                });
            });
        </script>

        <x-toast />

    </body>
</html>
