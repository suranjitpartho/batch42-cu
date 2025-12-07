<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Constitution Chapters') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-card-header">
                        <a href="{{ route('admin.constitutions.create') }}" class="admin-button-base admin-button-purple">
                            Create Chapter
                        </a>
                    </div>

                    <table class="admin-table">
                        <thead class="admin-table-thead">
                            <tr>
                                <th scope="col" class="admin-table-th">Order</th>
                                <th scope="col" class="admin-table-th">Chapter Number</th>
                                <th scope="col" class="admin-table-th">Chapter Name (EN)</th>
                                <th scope="col" class="admin-table-th">Chapter Name (BN)</th>
                                <th scope="col" class="admin-table-th">Active</th>
                                <th scope="col" class="admin-table-th-action">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="admin-table-tbody">
                            @foreach ($constitutions as $constitution)
                                <tr>
                                    <td class="admin-table-td">{{ $constitution->order }}</td>
                                    <td class="admin-table-td">{{ $constitution->chapter_number }}</td>
                                    <td class="admin-table-td">{{ $constitution->getTranslation('chapter_name', 'en') }}</td>
                                    <td class="admin-table-td">{{ $constitution->getTranslation('chapter_name', 'bn') }}</td>
                                    <td class="admin-table-td">
                                        <span class="admin-status-badge {{ $constitution->is_active ? 'status-5' : 'status-7' }}">{{ $constitution->is_active ? 'Yes' : 'No' }}</span>
                                    </td>
                                    <td class="admin-table-td admin-table-action-td">
                                        <a href="{{ route('admin.constitutions.edit', $constitution) }}" class="admin-table-action-icon" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.constitutions.destroy', $constitution) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-table-action-icon admin-table-action-icon-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this chapter?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="admin-pagination-container">
                        {{ $constitutions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
