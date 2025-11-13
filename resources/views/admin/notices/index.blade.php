<x-app-layout>
    <x-slot name="header">
        <div class="admin-header-flex">
            <h2 class="admin-header-title">
                {{ __('Notices') }}
            </h2>
        </div>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-card-header">
                        <form action="{{ route('admin.notices.index') }}" method="GET" class="admin-search-container">
                            <input type="text" name="search" placeholder="Search notices..." value="{{ request('search') }}" class="admin-search-input">
                            <button type="submit" class="admin-button-base admin-button-black">
                                Search
                            </button>
                        </form>
                        <a href="{{ route('admin.notices.create') }}" class="admin-button-base admin-button-purple">
                            Create Notice
                        </a>
                    </div>
                    <table class="admin-table">
                        <thead class="admin-table-thead">
                            <tr>
                                <th scope="col" class="admin-table-th">
                                    Title
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Content
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Members Only
                                </th>
                                <th scope="col" class="admin-table-th-action">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="admin-table-tbody">
                            @foreach ($notices as $notice)
                                <tr>
                                    <td class="admin-table-td">
                                        <span class="table-cell-content">{{ $notice->title }}</span>
                                    </td>
                                    <td class="admin-table-td">
                                        <span class="table-cell-content">{{ Str::limit($notice->content, 50) }}</span>
                                    </td>
                                    <td class="admin-table-td">
                                        @if ($notice->members_only)
                                            <span class="admin-status-badge status-2">Members Only</span>
                                        @else
                                            <span class="admin-status-badge status-8">Public</span>
                                        @endif
                                    </td>
                                    <td class="admin-table-td admin-table-action-td">
                                        <span class="table-cell-content">
                                            <a href="{{ route('admin.notices.edit', $notice) }}" class="admin-table-action-icon" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('admin.notices.destroy', $notice) }}" method="POST" class="inline-block ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="admin-table-action-icon admin-table-action-icon-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this notice?')">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="admin-pagination-container">
                        {{ $notices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>