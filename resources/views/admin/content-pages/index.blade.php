<x-app-layout>
    <x-slot name="header">
        <div class="admin-header-flex">
            <h2 class="admin-header-title">
                {{ __('Content Pages') }}
            </h2>
        </div>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-card-header">
                        <form action="{{ route('admin.content-pages.index') }}" method="GET" class="admin-search-container">
                            <input type="text" name="search" placeholder="Search content pages..." value="{{ request('search') }}" class="admin-search-input">
                            <button type="submit" class="admin-button-base admin-button-black">
                                Search
                            </button>
                        </form>
                    </div>
                    <table class="admin-table">
                        <thead class="admin-table-thead">
                            <tr>
                                <th scope="col" class="admin-table-th">
                                    Title
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Slug
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Published
                                </th>
                                <th scope="col" class="admin-table-th-action">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="admin-table-tbody">
                            @foreach ($contentPages as $contentPage)
                                <tr>
                                    <td class="admin-table-td">
                                        <span class="table-cell-content">{{ $contentPage->title }}</span>
                                    </td>
                                    <td class="admin-table-td">
                                        <span class="table-cell-content">{{ $contentPage->slug }}</span>
                                    </td>
                                    <td class="admin-table-td">
                                        @if ($contentPage->is_published)
                                            <span class="admin-status-badge status-4">Published</span>
                                        @else
                                            <span class="admin-status-badge status-7">Unpublished</span>
                                        @endif
                                    </td>
                                    <td class="admin-table-td admin-table-action-td">
                                        <span class="table-cell-content">
                                            <a href="{{ route('admin.content-pages.edit', $contentPage) }}" class="admin-table-action-icon" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="admin-pagination-container">
                        {{ $contentPages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>