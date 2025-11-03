<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="card-list">
                <div class="admin-card">
                    <div class="admin-card-body">
                        <div class="admin-form-container">
                            @include('admin.profile.partials.update-profile-photo-form')
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <div class="admin-card-body">
                        <div class="admin-form-container">
                            @include('admin.profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <div class="admin-card-body">
                        <div class="admin-form-container">
                            @include('admin.profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <div class="admin-card-body">
                        <div class="admin-form-container">
                            @include('admin.profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>