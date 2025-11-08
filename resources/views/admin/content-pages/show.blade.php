<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Content Page Details') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-detail-group">
                        <label class="admin-detail-label">Title:</label>
                        <p class="admin-detail-text">{{ $contentPage->title }}</p>
                    </div>
                    <div class="admin-detail-group">
                        <label class="admin-detail-label">Slug:</label>
                        <p class="admin-detail-text">{{ $contentPage->slug }}</p>
                    </div>
                    <div class="admin-detail-group">
                        <label class="admin-detail-label">Content:</label>
                        <div class="admin-detail-content-html">
                            {!! $contentPage->content !!}
                        </div>
                    </div>
                    <div class="admin-detail-group">
                        <label class="admin-detail-label">Published:</label>
                        <p class="admin-detail-text">{{ $contentPage->is_published ? 'Yes' : 'No' }}</p>
                    </div>
                    <div class="admin-detail-group">
                        <label class="admin-detail-label">Created At:</label>
                        <p class="admin-detail-text">{{ $contentPage->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="admin-detail-group">
                        <label class="admin-detail-label">Last Updated At:</label>
                        <p class="admin-detail-text">{{ $contentPage->updated_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="admin-form-actions">
                        <a href="{{ route('admin.content-pages.edit', $contentPage) }}" class="admin-button-base admin-button-purple">
                            Edit
                        </a>
                        <a href="{{ route('admin.content-pages.index') }}" class="admin-button-base admin-button-secondary">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>