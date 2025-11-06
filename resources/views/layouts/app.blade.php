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

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
    <body class="app-body">
        <x-topbar-loader />
        <div class="app-wrapper" x-data="{
    sidebarOpen: window.innerWidth > 768,

    handleSidebarNav(event) {
        event.preventDefault();
        const link = event.currentTarget;

        if (window.innerWidth <= 768 && this.sidebarOpen) {
            this.sidebarOpen = false;
            setTimeout(() => {
                window.location = link.href;
            }, 300);
        } else {
            window.location = link.href;
        }
    }
}" @toggle-sidebar="sidebarOpen = ! sidebarOpen" :class="{ 'sidebar-open': sidebarOpen && window.innerWidth <= 768 }">
            <div class="sidebar-container" :class="{ 'sidebar-closed': !sidebarOpen }">
                @include('admin.navigation') {{-- This will be the sidebar --}}
            </div>
            <div class="main-content-wrapper">
                @include('admin.top-navigation') {{-- This will be the top bar --}}

                <div class="admin-breadcrumb-container">
                    {{ Breadcrumbs::render() }}
                </div>

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                    <x-toast/>
                </main>
            </div>

            <!-- Mobile Sidebar Overlay -->
            <div x-show="sidebarOpen && window.innerWidth <= 768" @click="sidebarOpen = false" class="mobile-sidebar-overlay" style="display: none;"></div>
        </div>
@stack('scripts')
    </body>
</html>
