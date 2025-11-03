<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=barlow:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/admin/main.css', 'resources/css/components/main.css', 'resources/js/app.js'])
    </head>
    <body class="app-body">
        <div class="admin-dashboard-section guest-layout-container">
            <div class="guest-layout-card-container">
                <div class="guest-layout-logo-container">
                    <a href="/" class="guest-layout-logo-link">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo" class="guest-layout-logo">
                        <span class="guest-layout-logo-title">{{ config('app.name') }}</span>
                    </a>
                </div>
                <div class="admin-card guest-layout-card">
                    <div class="admin-card-body guest-layout-card-body">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
