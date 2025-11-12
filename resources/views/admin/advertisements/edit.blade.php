<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Edit Advertisement') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form action="{{ route('admin.advertisements.update', $advertisement) }}" method="POST" class="admin-form-vertical" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        {{-- Title --}}
                        <div class="admin-form-group">
                            <label for="title" class="admin-form-label">Title</label>
                            <input type="text" id="title" name="title" class="admin-form-input" value="{{ old('title', $advertisement->title) }}" required>
                            @error('title')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Type --}}
                        <div class="admin-form-group">
                            <label for="type" class="admin-form-label">Type</label>
                            <select id="type" name="type" class="admin-form-input" required>
                                <option value="lightbox" {{ old('type', $advertisement->type) == 'lightbox' ? 'selected' : '' }}>Lightbox</option>
                                <option value="footer" {{ old('type', $advertisement->type) == 'footer' ? 'selected' : '' }}>Footer</option>
                            </select>
                            @error('type')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div class="admin-form-group">
                            <label for="image" class="admin-form-label">New Image (Optional)</label>
                            <input type="file" id="image" name="image" class="admin-form-input">
                            @error('image')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                            <div class="mt-4">
                                <span class="admin-form-label">Current Image:</span>
                                <img src="{{ asset('storage/' . $advertisement->image_path) }}" alt="{{ $advertisement->title }}" class="mt-2 h-20 rounded">
                            </div>
                        </div>

                        {{-- Link URL --}}
                        <div class="admin-form-group">
                            <label for="link_url" class="admin-form-label">Link URL (Optional)</label>
                            <input type="url" id="link_url" name="link_url" class="admin-form-input" value="{{ old('link_url', $advertisement->link_url) }}">
                            @error('link_url')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Order --}}
                        <div class="admin-form-group">
                            <label for="order" class="admin-form-label">Order</label>
                            <input type="number" id="order" name="order" class="admin-form-input" value="{{ old('order', $advertisement->order) }}" required>
                            @error('order')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Is Active --}}
                        <div class="admin-form-group">
                            <label class="admin-form-label">Status</label>
                            <div class="admin-checkbox-container">
                                <input type="checkbox" id="is_active" name="is_active" value="1" class="admin-form-checkbox" {{ old('is_active', $advertisement->is_active) ? 'checked' : '' }}>
                                <label for="is_active" class="admin-checkbox-label">Active</label>
                            </div>
                            @error('is_active')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                Update Advertisement
                            </button>
                            <a href="{{ route('admin.advertisements.index') }}" class="admin-button-base admin-button-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
