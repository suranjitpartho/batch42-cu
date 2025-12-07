<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Video Gallery') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-card-header">
                        <a href="{{ route('admin.video-galleries.create') }}" class="admin-button-base admin-button-purple">
                            Add New Video
                        </a>
                    </div>

                    <table class="admin-table">
                        <thead class="admin-table-thead">
                            <tr>
                                <th scope="col" class="admin-table-th">Thumbnail</th>
                                <th scope="col" class="admin-table-th">Title</th>
                                <th scope="col" class="admin-table-th">YouTube URL</th>
                                <th scope="col" class="admin-table-th">Status</th>
                                <th scope="col" class="admin-table-th">Order</th>
                                <th scope="col" class="admin-table-th-action">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="admin-table-tbody">
                            @forelse($videos as $video)
                                <tr>
                                    <td class="admin-table-td">
                                        <img src="https://img.youtube.com/vi/{{ $video->video_id }}/default.jpg" alt="Thumbnail" class="w-24 h-auto rounded">
                                    </td>
                                    <td class="admin-table-td">{{ $video->title }}</td>
                                    <td class="admin-table-td">
                                        <a href="{{ $video->youtube_url }}" target="_blank" class="text-blue-600 hover:underline">{{ Str::limit($video->youtube_url, 30) }}</a>
                                    </td>
                                    <td class="admin-table-td">
                                        <span class="admin-status-badge {{ $video->is_active ? 'status-5' : 'status-7' }}">
                                            {{ $video->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="admin-table-td">{{ $video->order }}</td>
                                    <td class="admin-table-td admin-table-action-td">
                                        <a href="{{ route('admin.video-galleries.edit', $video->id) }}" class="admin-table-action-icon" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.video-galleries.destroy', $video->id) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-table-action-icon admin-table-action-icon-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this video?');">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="admin-table-td text-center">No videos found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="admin-pagination-container">
                        {{ $videos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
