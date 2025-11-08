<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-card-header">
                        <form action="{{ route('admin.users.index') }}" method="GET" class="admin-search-container">
                            <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}" class="admin-search-input">
                            <button type="submit" class="admin-button-base admin-button-black">
                                Search
                            </button>
                        </form>
                        <a href="{{ route('admin.users.create') }}" class="admin-button-base admin-button-purple">
                            Create User
                        </a>
                    </div>


                    <table class="admin-table">
                        <thead class="admin-table-thead">
                            <tr>
                                <th scope="col" class="admin-table-th mobile-visible-column">Name</th>
                                <th scope="col" class="admin-table-th">Email</th>
                                <th scope="col" class="admin-table-th">Email Verified</th>
                                <th scope="col" class="admin-table-th">Role</th>
                                <th scope="col" class="admin-table-th">Status</th>
                                <th scope="col" class="admin-table-th-action mobile-visible-column">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="admin-table-tbody">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="admin-table-td mobile-visible-column"><span class="table-cell-content">{{ $user->name }}</span></td>
                                    <td class="admin-table-td">{{ $user->email }}</td>
                                    <td class="admin-table-td">
                                        @if ($user->hasVerifiedEmail())
                                            <span class="admin-status-badge status-5">Verified</span>
                                        @else
                                            <span class="admin-status-badge status-7">Unverified</span>
                                        @endif
                                    </td>
                                    <td class="admin-table-td">
                                        @foreach($user->getRoleNames() as $role)
                                            <span class="admin-status-badge status-8">{{ $role }}</span>
                                        @endforeach
                                    </td>
                                    <td class="admin-table-td">
                                        <span class="admin-status-badge {{ $user->status === 'active' ? 'status-5' : 'status-7' }}">{{ ucfirst($user->status) }}</span>
                                    </td>
                                    <td class="admin-table-td admin-table-action-td mobile-visible-column">
                                        <span class="table-cell-content">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="admin-table-action-icon" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="admin-table-action-icon admin-table-action-icon-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this user?')">
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
