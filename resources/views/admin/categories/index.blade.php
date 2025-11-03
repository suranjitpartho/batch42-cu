<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-card-header">
                        <form action="{{ route('admin.categories.index') }}" method="GET" class="admin-search-container">
                            <input type="text" name="search" placeholder="Search categories..." value="{{ request('search') }}" class="admin-search-input">
                            <button type="submit" class="admin-button-base admin-button-black">
                                Search
                            </button>
                        </form>
                        <a href="{{ route('admin.categories.create') }}" class="admin-button-base admin-button-purple">
                            Create Category
                        </a>
                    </div>
                    <div class="admin-table-responsive-wrapper">
                        <table class="admin-table">
                            <thead class="admin-table-thead">
                                <tr>
                                    <th scope="col" class="admin-table-th">
                                        Image
                                    </th>
                                    <th scope="col" class="admin-table-th mobile-visible-column">
                                        Name
                                    </th>
                                    <th scope="col" class="admin-table-th">
                                        Slug
                                    </th>
                                    <th scope="col" class="admin-table-th">
                                        Parent Category
                                    </th>
                                    <th scope="col" class="admin-table-th-action mobile-visible-column">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="admin-table-tbody">
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="admin-table-td">
                                            <img src="{{ $category->image_path ? asset('storage/' . $category->image_path) : 'https://via.placeholder.com/300x200' }}" alt="{{ $category->name }}" class="admin-table-image">
                                        </td>
                                        <td class="admin-table-td mobile-visible-column">
                                            <span class="table-cell-content">{{ $category->name }}</span>
                                        </td>
                                        <td class="admin-table-td">
                                            {{ $category->slug }}
                                        </td>
                                        <td class="admin-table-td">
                                            {{ $category->parent->name ?? 'None' }}
                                        </td>
                                        <td class="admin-table-td admin-table-action-td mobile-visible-column">
                                            <span class="table-cell-content">
                                                <a href="{{ route('admin.categories.edit', $category) }}" class="admin-table-action-link">Edit</a>
                                            </span>
                                        </td>
                                    </tr>                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="admin-pagination-container">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>