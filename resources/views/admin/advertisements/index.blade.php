<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Advertisements') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-card-header">
                        <form action="{{ route('admin.advertisements.index') }}" method="GET" class="admin-search-container">
                            <input type="text" name="search" placeholder="Search advertisements..." value="{{ request('search') }}" class="admin-search-input">
                            <button type="submit" class="admin-button-base admin-button-black">
                                Search
                            </button>
                        </form>
                        <a href="{{ route('admin.advertisements.create') }}" class="admin-button-base admin-button-purple">
                            {{ __('Create Advertisement') }}
                        </a>
                    </div>
                    <table class="admin-table">
                        <thead class="admin-table-thead">
                            <tr>
                                <th scope="col" class="admin-table-th">
                                    Title
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Type
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Status
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Order
                                </th>
                                <th scope="col" class="admin-table-th-action">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="admin-table-tbody">
                            @forelse ($advertisements as $ad)
                                <tr>
                                    <td class="admin-table-td">
                                        <span class="table-cell-content">{{ $ad->title }}</span>
                                    </td>
                                    <td class="admin-table-td">
                                        <span class="table-cell-content">{{ ucfirst($ad->type) }}</span>
                                    </td>
                                    <td class="admin-table-td">
                                        @if ($ad->is_active)
                                            <span class="admin-status-badge status-4">Active</span>
                                        @else
                                            <span class="admin-status-badge status-1">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="admin-table-td">
                                        <span class="table-cell-content">{{ $ad->order }}</span>
                                    </td>
                                    <td class="admin-table-td admin-table-action-td">
                                        <span class="table-cell-content">
                                            <a href="{{ route('admin.advertisements.edit', $ad) }}" class="admin-table-action-icon" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('admin.advertisements.destroy', $ad) }}" method="POST" class="inline-block ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="admin-table-action-icon admin-table-action-icon-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this advertisement?')">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="admin-table-td text-center">
                                        No advertisements found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="admin-pagination-container">
                        {{ $advertisements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
