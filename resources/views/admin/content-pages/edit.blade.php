<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Edit Content Page') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card" x-data="{ activeTab: 'en' }">
                <div class="admin-card-body">
                    <div class="admin-tabs-container">
                        <div class="admin-tabs">
                            <button @click="activeTab = 'en'" :class="{'admin-tab-active': activeTab === 'en'}" class="admin-tab-item">English</button>
                            <button @click="activeTab = 'bn'" :class="{'admin-tab-active': activeTab === 'bn'}" class="admin-tab-item">Bengali</button>
                        </div>
                    </div>

                    <form action="{{ route('admin.content-pages.update', $contentPage) }}" method="POST" class="admin-form-vertical">
                        @csrf
                        @method('PUT')

                        {{-- English Fields --}}
                        <div x-show="activeTab === 'en'" class="admin-tab-content admin-form-vertical">
                            <div class="admin-form-group">
                                <label for="title_en" class="admin-form-label">Title (English)</label>
                                <input type="text" id="title_en" name="title_en" class="admin-form-input" value="{{ old('title_en', $contentPage->getTranslation('title', 'en')) }}" readonly>
                            </div>
                            <div class="admin-form-group">
                                <label for="content_en" class="admin-form-label">Content (English)</label>
                                <textarea id="content_en" name="content_en" class="admin-form-textarea" required>{{ old('content_en', $contentPage->getTranslation('content', 'en')) }}</textarea>
                            </div>
                        </div>

                        {{-- Bengali Fields --}}
                        <div x-show="activeTab === 'bn'" class="admin-tab-content admin-form-vertical" style="display: none;">
                            <div class="admin-form-group">
                                <label for="title_bn" class="admin-form-label">Title (Bengali)</label>
                                <input type="text" id="title_bn" name="title_bn" class="admin-form-input" value="{{ old('title_bn', $contentPage->getTranslation('title', 'bn')) }}" readonly>
                            </div>
                            <div class="admin-form-group">
                                <label for="content_bn" class="admin-form-label">Content (Bengali)</label>
                                <textarea id="content_bn" name="content_bn" class="admin-form-textarea" required>{{ old('content_bn', $contentPage->getTranslation('content', 'bn')) }}</textarea>
                            </div>
                        </div>

                        {{-- Shared Fields --}}
                        <div class="admin-form-group">
                            <label for="slug" class="admin-form-label">Slug</label>
                            <input type="text" id="slug" name="slug" class="admin-form-input" value="{{ old('slug', $contentPage->slug) }}" readonly>
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label">Published</label>
                            <div class="admin-checkbox-container">
                                <input type="checkbox" id="is_published" name="is_published" value="1" class="admin-form-checkbox" {{ old('is_published', $contentPage->is_published) ? 'checked' : '' }}>
                                <label for="is_published" class="admin-checkbox-label">Make this page publicly visible</label>
                            </div>
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                Update Content Page
                            </button>
                            <a href="{{ route('admin.content-pages.index') }}" class="admin-button-base admin-button-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>