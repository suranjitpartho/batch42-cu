<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form action="{{ route('admin.products.update', $product) }}" class="admin-form-vertical" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="admin-form-grid">
                            <div class="admin-form-grid-item">
                                <label for="name" class="admin-form-label">Name</label>
                                <input type="text" name="name" id="name" class="admin-form-input" value="{{ old('name', $product->name) }}" required autofocus>
                            </div>
                            <div class="admin-form-grid-item">
                                <label for="category_id" class="admin-form-label">Category</label>
                                <select name="category_id" id="category_id" class="admin-form-select">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if($category->id == old('category_id', $product->category_id)) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="admin-form-grid-item">
                                <label for="price" class="admin-form-label">Price</label>
                                <input type="number" name="price" id="price" step="0.01" class="admin-form-input" value="{{ old('price', $product->price) }}" required>
                            </div>
                            <div class="admin-form-grid-item">
                                <label for="stock_quantity" class="admin-form-label">Stock Quantity</label>
                                <input type="number" name="stock_quantity" id="stock_quantity" class="admin-form-input" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                            </div>
                            <div class="admin-form-grid-item-full">
                                <label for="description" class="admin-form-label">Description</label>
                                <textarea name="description" id="description" rows="4" class="admin-form-textarea" required>{{ old('description', $product->description) }}</textarea>
                            </div>
                            <div class="admin-form-grid-item-full">
                                <label for="image" class="admin-form-label">Product Image</label>
                                <input type="file" name="image" id="image" class="admin-form-file-input">
                                @if ($product->image_path)
                                    <div class="admin-image-preview-container">
                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="admin-image-preview">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                Update Product
                            </button>
                        </div>
                    </form>

                    <div class="admin-delete-section">
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-button-base admin-button-danger">Delete Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>