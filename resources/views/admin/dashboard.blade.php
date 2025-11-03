<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="dashboard-stats-grid">
                        <div class="dashboard-stat-card">
                            <div class="dashboard-stat-icon"><i class="fa-solid fa-users"></i></div>
                            <div class="dashboard-stat-info">
                                <h3 class="dashboard-stat-title">Total Users</h3>
                                <p class="dashboard-stat-value">{{ $userCount }}</p>
                            </div>
                        </div>
                        <div class="dashboard-stat-card">
                            <div class="dashboard-stat-icon"><i class="fa-solid fa-user-tag"></i></div>
                            <div class="dashboard-stat-info">
                                <h3 class="dashboard-stat-title">Total Roles</h3>
                                <p class="dashboard-stat-value">{{ $roleCount }}</p>
                            </div>
                        </div>
                        <div class="dashboard-stat-card">
                            <div class="dashboard-stat-icon"><i class="fa-solid fa-shield-halved"></i></div>
                            <div class="dashboard-stat-info">
                                <h3 class="dashboard-stat-title">Total Permissions</h3>
                                <p class="dashboard-stat-value">{{ $permissionCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
