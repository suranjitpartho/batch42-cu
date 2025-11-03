<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="admin-form-vertical">
                        @csrf
                        @method('PUT')
                        <div class="admin-form-group">
                            <label for="name" class="admin-form-label">Name</label>
                            <input type="text" name="name" id="name" class="admin-form-input" value="{{ old('name', $category->name) }}" required autofocus>
                        </div>

                        <div class="admin-form-group">
                            <label for="parent_id" class="admin-form-label">Parent Category</label>
                            <select name="parent_id" id="parent_id" class="admin-form-select">
                                <option value="">None</option>
                                @foreach ($categories as $parentCategory)
                                    <option value="{{ $parentCategory->id }}" @if($parentCategory->id == old('parent_id', $category->parent_id)) selected @endif>{{ $parentCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="admin-form-group">
                            <label for="image" class="admin-form-label">Image</label>
                            <input type="file" name="image" id="image" class="admin-form-file-input">
                            @if ($category->image_path)
                                <div class="admin-image-preview-container">
                                    <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" class="admin-image-preview">
                                </div>
                            @endif
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                Update
                            </button>
                        </div>
                    </form>

                    <div class="admin-delete-section">
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-button-base admin-button-danger">Delete Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>