<x-app-layout>
    <x-slot name="header">
        <div class="admin-header-flex">
            <h2 class="admin-header-title">
                {{ __('Membership Applications') }}
            </h2>
        </div>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-card-header">
                        <form action="{{ route('admin.memberships.index') }}" method="GET" class="admin-search-container">
                            <input type="text" name="search" placeholder="Search memberships..." value="{{ request('search') }}" class="admin-search-input">
                            <button type="submit" class="admin-button-base admin-button-black">
                                Search
                            </button>
                        </form>
                    </div>
                    <table class="admin-table">
                        <thead class="admin-table-thead">
                            <tr>
                                <th scope="col" class="admin-table-th">
                                    Applicant
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Department
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Phone
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Status
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Applied At
                                </th>
                                <th scope="col" class="admin-table-th-action">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="admin-table-tbody">
                            @foreach ($memberships as $membership)
                                <tr>
                                    <td class="admin-table-td">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $membership->user->profile_photo_path ? asset('storage/' . $membership->user->profile_photo_path) : asset('images/default-avatar.svg') }}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $membership->user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $membership->user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="admin-table-td">
                                        <span class="table-cell-content">{{ $membership->user->department }}</span>
                                    </td>
                                    <td class="admin-table-td">
                                        <span class="table-cell-content">{{ $membership->user->phone_number }}</span>
                                    </td>
                                    <td class="admin-table-td">
                                        @switch($membership->status)
                                            @case('approved')
                                                <span class="admin-status-badge status-4">{{ ucfirst($membership->status) }}</span>
                                                @break
                                            @case('rejected')
                                                <span class="admin-status-badge status-1">{{ ucfirst($membership->status) }}</span>
                                                @break
                                            @case('pending')
                                                <span class="admin-status-badge status-2">{{ ucfirst($membership->status) }}</span>
                                                @break
                                            @default
                                                <span class="admin-status-badge status-8">{{ ucfirst($membership->status) }}</span>
                                        @endswitch
                                    </td>
                                    <td class="admin-table-td">
                                        <span class="table-cell-content">{{ $membership->applied_at->format('d M, Y') }}</span>
                                    </td>
                                    <td class="admin-table-td admin-table-action-td">
                                        <span class="table-cell-content">
                                            <a href="{{ route('admin.memberships.show', $membership) }}" class="admin-table-action-icon" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            @if ($membership->status === 'pending')
                                                <form action="{{ route('admin.memberships.approve', $membership) }}" method="POST" class="inline-block ml-2">
                                                    @csrf
                                                    <button type="submit" class="admin-table-action-icon" title="Approve">
                                                        <i class="fa-solid fa-circle-check"></i>
                                                    </button>
                                                </form>
                                                <button type="button" class="admin-table-action-icon admin-table-action-icon-danger ml-2" title="Reject" x-on:click.prevent="$dispatch('open-modal', 'reject-membership-{{ $membership->id }}')">
                                                    <i class="fa-solid fa-ban"></i>
                                                </button>
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="admin-pagination-container">
                        {{ $memberships->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($memberships as $membership)
        @if ($membership->status === 'pending')
            <x-modal name="reject-membership-{{ $membership->id }}" :show="$errors->rejectMembership->any()" focusable>
                <form method="post" action="{{ route('admin.memberships.reject', $membership) }}" class="modal-form admin-form-vertical">
                    @csrf

                    <h2 class="admin-detail-heading">
                        {{ __('Are you sure you want to reject this membership application?') }}
                    </h2>

                    <p class="admin-section-description">
                        {{ __('Please enter the reason for rejecting this membership application.') }}
                    </p>

                    <div class="admin-form-group">
                        <label for="rejection_reason" class="admin-form-label sr-only">{{ __('Reason for Rejection') }}</label>

                        <textarea
                            id="rejection_reason"
                            name="rejection_reason"
                            class="admin-form-input"
                            placeholder="{{ __('Reason for Rejection') }}"
                        ></textarea>

                        @error('rejection_reason', 'rejectMembership')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="admin-form-actions">
                        <button type="button" class="admin-button-base admin-button-secondary" x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </button>

                        <button type="submit" class="admin-button-base admin-button-danger">
                            {{ __('Reject Membership') }}
                        </button>
                    </div>
                </form>
            </x-modal>
        @endif
    @endforeach
</x-app-layout>