<x-app-layout>
    <x-slot name="header">
        <div class="admin-header-flex">
            <h2 class="admin-header-title">
                {{ __('Roles') }}
            </h2>
        </div>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-card-header">
                        <form action="{{ route('admin.roles.index') }}" method="GET" class="admin-search-container">
                            <input type="text" name="search" placeholder="Search roles..." value="{{ request('search') }}" class="admin-search-input">
                            <button type="submit" class="admin-button-base admin-button-black">
                                Search
                            </button>
                        </form>
                        <a href="{{ route('admin.roles.create') }}" class="admin-button-base admin-button-purple">
                            Create Role
                        </a>
                    </div>
                    <table class="admin-table">
                        <thead class="admin-table-thead">
                            <tr>
                                <th scope="col" class="admin-table-th mobile-visible-column">
                                    Name
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Permissions
                                </th>
                                <th scope="col" class="admin-table-th-action mobile-visible-column">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="admin-table-tbody">
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="admin-table-td mobile-visible-column">
                                        <span class="table-cell-content">{{ $role->name }}</span>
                                    </td>
                                    <td class="admin-table-td">
                                        {{ $role->permissions->count() }}
                                    </td>
                                    <td class="admin-table-td admin-table-action-td mobile-visible-column">
                                        <span class="table-cell-content">
                                            <a href="{{ route('admin.roles.edit', $role) }}" class="admin-table-action-icon" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="inline-block ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="admin-table-action-icon admin-table-action-icon-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this role?')">
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
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
