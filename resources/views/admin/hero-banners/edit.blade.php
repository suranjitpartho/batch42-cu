<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Edit Hero Banner') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form action="{{ route('admin.hero-banners.update', $heroBanner) }}" method="POST" enctype="multipart/form-data" class="admin-form-vertical">
                        @csrf
                        @method('PUT')
                        <div class="admin-form-group">
                            <label for="title" class="admin-form-label">Title</label>
                            <input type="text" name="title" id="title" class="admin-form-input" value="{{ old('title', $heroBanner->title) }}" required autofocus>
                        </div>

                        <div class="admin-form-group">
                            <label for="subtitle" class="admin-form-label">Subtitle</label>
                            <input type="text" name="subtitle" id="subtitle" class="admin-form-input" value="{{ old('subtitle', $heroBanner->subtitle) }}" required>
                        </div>

                        <div class="admin-form-group">
                            <label for="image" class="admin-form-label">Image</label>
                            <input type="file" name="image" id="image" class="admin-form-file-input">
                            @error('image')
                                <ul class="admin-input-error">
                                    @foreach ($errors->get('image') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            @enderror
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $heroBanner->image_path) }}" alt="{{ $heroBanner->title }}" class="admin-table-image">
                            </div>
                        </div>

                        <div class="admin-form-group">
                            <label for="order" class="admin-form-label">Order</label>
                            <input type="number" name="order" id="order" class="admin-form-input" value="{{ old('order', $heroBanner->order) }}" required>
                        </div>

                        <div class="admin-form-group">
                            <label for="is_active" class="admin-form-label">Status</label>
                            <select name="is_active" id="is_active" class="admin-form-select">
                                <option value="1" {{ old('is_active', $heroBanner->is_active) ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !old('is_active', $heroBanner->is_active) ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
