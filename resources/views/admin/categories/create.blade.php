<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="admin-form-vertical">
                        @csrf
                        <div class="admin-form-group">
                            <label for="name" class="admin-form-label">Name</label>
                            <input type="text" name="name" id="name" class="admin-form-input" required autofocus>
                        </div>

                        <div class="admin-form-group">
                            <label for="parent_id" class="admin-form-label">Parent Category</label>
                            <select name="parent_id" id="parent_id" class="admin-form-select">
                                <option value="">None</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="admin-form-group">
                            <label for="image" class="admin-form-label">Image</label>
                            <input type="file" name="image" id="image" class="admin-form-file-input">
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>