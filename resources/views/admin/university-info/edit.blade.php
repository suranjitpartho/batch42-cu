<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('University Information') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="card-list">
                @include('admin.university-info.partials.update-textual-info-form')
                @include('admin.university-info.partials.update-university-images-form')
                @include('admin.university-info.partials.update-batch-images-form')
            </div>
        </div>
    </div>
</x-app-layout>
