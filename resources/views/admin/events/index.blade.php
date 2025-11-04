<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-card-header">
                        <a href="{{ route('admin.events.create') }}" class="admin-button-base admin-button-purple">
                            Create Event
                        </a>
                    </div>


                    <table class="admin-table">
                        <thead class="admin-table-thead">
                            <tr>
                                <th scope="col" class="admin-table-th">Title</th>
                                <th scope="col" class="admin-table-th">Date</th>
                                <th scope="col" class="admin-table-th">Location</th>
                                <th scope="col" class="admin-table-th">Published</th>
                                <th scope="col" class="admin-table-th-action">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="admin-table-tbody">
                            @foreach ($events as $event)
                                <tr>
                                    <td class="admin-table-td">{{ $event->title }}</td>
                                    <td class="admin-table-td">{{ $event->date->format('d M Y, H:i') }}</td>
                                    <td class="admin-table-td">{{ $event->location }}</td>
                                    <td class="admin-table-td">
                                        <span class="admin-status-badge {{ $event->is_published ? 'status-5' : 'status-7' }}">{{ $event->is_published ? 'Yes' : 'No' }}</span>
                                    </td>
                                    <td class="admin-table-td admin-table-action-td">
                                        <a href="{{ route('admin.events.edit', $event) }}" class="admin-table-action-icon" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-table-action-icon admin-table-action-icon-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this event?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="admin-pagination-container">
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
