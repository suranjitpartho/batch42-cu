<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Executive Committees') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-card-header">
                        <a href="{{ route('admin.executive-committees.create') }}" class="admin-button-base admin-button-purple">
                            Upload New Committee
                        </a>
                    </div>

                    <table class="admin-table">
                        <thead class="admin-table-thead">
                            <tr>
                                <th scope="col" class="admin-table-th">Year</th>
                                <th scope="col" class="admin-table-th">Document</th>
                                <th scope="col" class="admin-table-th">Status</th>
                                <th scope="col" class="admin-table-th-action">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="admin-table-tbody">
                            @forelse ($committees as $committee)
                                <tr>
                                    <td class="admin-table-td">{{ $committee->year }}</td>
                                    <td class="admin-table-td">
                                        <a href="{{ asset('storage/' . $committee->document_path) }}" target="_blank" class="text-blue-600 hover:underline">
                                            View PDF
                                        </a>
                                    </td>
                                    <td class="admin-table-td">
                                        <span class="admin-status-badge {{ $committee->is_active ? 'status-5' : 'status-7' }}">
                                            {{ $committee->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="admin-table-td admin-table-action-td">
                                        <a href="{{ route('admin.executive-committees.edit', $committee) }}" class="admin-table-action-icon" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.executive-committees.destroy', $committee) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-table-action-icon admin-table-action-icon-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this committee?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-500">No executive committees found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="admin-pagination-container">
                        {{ $committees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
