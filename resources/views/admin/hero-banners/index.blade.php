<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Hero Banners') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-card-header">
                        <form action="{{ route('admin.hero-banners.index') }}" method="GET" class="admin-search-container">
                            <input type="text" name="search" placeholder="Search banners..." value="{{ request('search') }}" class="admin-search-input">
                            <button type="submit" class="admin-button-base admin-button-black">
                                Search
                            </button>
                        </form>
                        @if ($heroBannersCount < 5)
                            <a href="{{ route('admin.hero-banners.create') }}" class="admin-button-base admin-button-purple">
                                Create Banner
                            </a>
                        @else
                            <p class="admin-text-secondary">Maximum of 5 banners reached.</p>
                        @endif
                    </div>
                    <div class="admin-table-responsive-wrapper">
                        <table class="admin-table">
                            <thead class="admin-table-thead">
                                <tr>
                                    <th scope="col" class="admin-table-th">
                                        Image
                                    </th>
                                    <th scope="col" class="admin-table-th mobile-visible-column">
                                        Title
                                    </th>
                                    <th scope="col" class="admin-table-th">
                                        Subtitle
                                    </th>
                                    <th scope="col" class="admin-table-th">
                                        Order
                                    </th>
                                    <th scope="col" class="admin-table-th">
                                        Status
                                    </th>
                                    <th scope="col" class="admin-table-th-action mobile-visible-column">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="admin-table-tbody">
                                @foreach ($heroBanners as $banner)
                                    <tr>
                                        <td class="admin-table-td">
                                            <img src="{{ $banner->image_path ? asset('storage/' . $banner->image_path) : 'https://via.placeholder.com/300x200' }}" alt="{{ $banner->title }}" class="admin-table-image">
                                        </td>
                                        <td class="admin-table-td mobile-visible-column">
                                            <span class="table-cell-content">{{ $banner->title }}</span>
                                        </td>
                                        <td class="admin-table-td">
                                            {{ $banner->subtitle }}
                                        </td>
                                        <td class="admin-table-td">
                                            {{ $banner->order }}
                                        </td>
                                        <td class="admin-table-td">
                                            <span class="{{ $banner->is_active ? 'admin-badge-success' : 'admin-badge-danger' }}">
                                                {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="admin-table-td admin-table-action-td mobile-visible-column">
                                            <span class="table-cell-content">
                                                <a href="{{ route('admin.hero-banners.edit', $banner) }}" class="admin-table-action-icon" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <form action="{{ route('admin.hero-banners.destroy', $banner) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Are you sure you want to delete this banner?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="admin-table-action-icon admin-table-action-icon-danger" title="Delete">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </span>
                                        </td>
                                    </tr>                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="admin-pagination-container">
                        {{ $heroBanners->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
