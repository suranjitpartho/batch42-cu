<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="admin-form-vertical">
                        @csrf
                        <div class="admin-form-grid">
                            <div class="admin-form-grid-item">
                                <label for="name" class="admin-form-label">Name</label>
                                <input type="text" name="name" id="name" class="admin-form-input" required autofocus>
                            </div>
                            <div class="admin-form-grid-item">
                                <label for="category_id" class="admin-form-label">Category</label>
                                <select name="category_id" id="category_id" class="admin-form-select" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="admin-form-grid-item">
                                <label for="price" class="admin-form-label">Price</label>
                                <input type="number" name="price" id="price" step="0.01" class="admin-form-input" required>
                            </div>
                            <div class="admin-form-grid-item">
                                <label for="stock_quantity" class="admin-form-label">Stock Quantity</label>
                                <input type="number" name="stock_quantity" id="stock_quantity" class="admin-form-input" required>
                            </div>
                            <div class="admin-form-grid-item-full">
                                <label for="description" class="admin-form-label">Description</label>
                                <textarea name="description" id="description" rows="4" class="admin-form-textarea" required></textarea>
                            </div>
                             <div class="admin-form-grid-item-full">
                                <label for="image" class="admin-form-label">Product Image</label>
                                <input type="file" name="image" id="image" class="admin-form-file-input">
                            </div>
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                Create Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>