<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Edit Content Page') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form action="{{ route('admin.content-pages.update', $contentPage) }}" method="POST" class="admin-form-vertical">
                        @csrf
                        @method('PUT')
                        
                        {{-- Title --}}
                        <div class="admin-form-group">
                            <label for="title" class="admin-form-label">Title</label>
                            <input type="text" id="title" name="title" class="admin-form-input" value="{{ old('title', $contentPage->title) }}" readonly>
                            @error('title')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="admin-form-group">
                            <label for="slug" class="admin-form-label">Slug</label>
                            <input type="text" id="slug" name="slug" class="admin-form-input" value="{{ old('slug', $contentPage->slug) }}" readonly>
                            @error('slug')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Content --}}
                        <div class="admin-form-group">
                            <label for="content" class="admin-form-label">Content</label>
                            <textarea id="content" name="content" class="admin-form-textarea" required>{{ old('content', $contentPage->content) }}</textarea>
                            @error('content')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Published --}}
                        <div class="admin-form-group">
                            <label class="admin-form-label">Published</label>
                            <div class="admin-checkbox-container">
                                <input type="checkbox" id="is_published" name="is_published" value="1" class="admin-form-checkbox" {{ old('is_published', $contentPage->is_published) ? 'checked' : '' }}>
                                <label for="is_published" class="admin-checkbox-label">Make this page publicly visible</label>
                            </div>
                            @error('is_published')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
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