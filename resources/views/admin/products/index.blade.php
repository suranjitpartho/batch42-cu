<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-card-header">
                        <form action="{{ route('admin.products.index') }}" method="GET" class="admin-search-container">
                            <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}" class="admin-search-input">
                            <button type="submit" class="admin-button-base admin-button-black">
                                Search
                            </button>
                        </form>
                        <a href="{{ route('admin.products.create') }}" class="admin-button-base admin-button-purple">
                            Create Product
                        </a>
                    </div>
                    <table class="admin-table">
                        <thead class="admin-table-thead">
                            <tr>
                                <th scope="col" class="admin-table-th">
                                    Image
                                </th>
                                <th scope="col" class="admin-table-th">
                                    SKU
                                </th>
                                <th scope="col" class="admin-table-th mobile-visible-column">
                                    Name
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Category
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Price
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Stock
                                </th>
                                <th scope="col" class="admin-table-th-action mobile-visible-column">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="admin-table-tbody">
                            @foreach ($products as $product)
                                <tr>
                                     <td class="admin-table-td">
                                        <img src="{{ asset('storage/' . $product->image_path) ?? 'https://via.placeholder.com/300x400' }}" alt="{{ $product->name }}" class="admin-table-image">
                                    </td>
                                    <td class="admin-table-td">
                                        {{ $product->sku }}
                                    </td>
                                    <td class="admin-table-td mobile-visible-column">
                                        <span class="table-cell-content">{{ $product->name }}</span>
                                    </td>
                                    <td class="admin-table-td">
                                        {{ $product->category->name ?? 'None' }}
                                    </td>
                                    <td class="admin-table-td">
                                        {{ $product->price }}
                                    </td>
                                    <td class="admin-table-td">
                                        {{ $product->stock_quantity }}
                                    </td>
                                    <td class="admin-table-td admin-table-action-td mobile-visible-column">
                                        <span class="table-cell-content">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="admin-table-action-icon" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="admin-pagination-container">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>