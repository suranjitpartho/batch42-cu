<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Edit Video') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form action="{{ route('admin.video-galleries.update', $videoGallery->id) }}" method="POST" class="admin-form-vertical">
                        @csrf
                        @method('PUT')
                        
                        {{-- Title --}}
                        <div class="admin-form-group">
                            <label for="title" class="admin-form-label">Title <span class="text-red-500">*</span></label>
                            <input type="text" id="title" name="title" class="admin-form-input" value="{{ old('title', $videoGallery->title) }}" required>
                            @error('title')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- YouTube URL --}}
                        <div class="admin-form-group">
                            <label for="youtube_url" class="admin-form-label">YouTube URL <span class="text-red-500">*</span></label>
                            <input type="url" id="youtube_url" name="youtube_url" class="admin-form-input" value="{{ old('youtube_url', $videoGallery->youtube_url) }}" placeholder="https://www.youtube.com/watch?v=..." required>
                            <p class="text-sm text-gray-500 mt-1">Paste the full YouTube video URL here.</p>
                            @error('youtube_url')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="admin-form-group">
                            <label for="description" class="admin-form-label">Description</label>
                            <textarea id="description" name="description" class="admin-form-textarea" rows="3">{{ old('description', $videoGallery->description) }}</textarea>
                            @error('description')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Order --}}
                            <div class="admin-form-group">
                                <label for="order" class="admin-form-label">Order</label>
                                <input type="number" id="order" name="order" class="admin-form-input" value="{{ old('order', $videoGallery->order) }}">
                                <p class="text-sm text-gray-500 mt-1">Lower numbers appear first.</p>
                                @error('order')
                                    <p class="admin-input-error">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            {{-- Active Status --}}
                            <div class="admin-form-group">
                                <label class="admin-form-label">Status</label>
                                <div class="admin-checkbox-container">
                                    <input type="checkbox" id="is_active" name="is_active" value="1" class="admin-form-checkbox" {{ old('is_active', $videoGallery->is_active) ? 'checked' : '' }}>
                                    <label for="is_active" class="admin-checkbox-label">Active</label>
                                </div>
                            </div>
                        </div>

                        {{-- Thumbnail Preview --}}
                        <div class="admin-form-group">
                            <label class="admin-form-label">Current Thumbnail Preview</label>
                            <div class="mt-2">
                                <img src="https://img.youtube.com/vi/{{ $videoGallery->video_id }}/mqdefault.jpg" alt="Thumbnail" class="rounded shadow-md" style="max-width: 300px;">
                            </div>
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                Update Video
                            </button>
                            <a href="{{ route('admin.video-galleries.index') }}" class="admin-button-base admin-button-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
