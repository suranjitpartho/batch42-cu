<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Membership Application Details') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="card-list">

                {{-- Card 1: Applicant & Application Details --}}
                <div class="admin-card">
                    <div class="admin-card-body">
                        <div class="admin-order-details-grid">
                            {{-- Applicant Details --}}
                            <div>
                                <h3 class="admin-detail-heading">Applicant Information</h3>
                                <div class="admin-detail-group">
                                    <p class="admin-text-secondary"><strong>Name:</strong> {{ $membership->user->name }}</p>
                                    <p class="admin-text-secondary"><strong>Email:</strong> <a href="mailto:{{ $membership->user->email }}" class="text-blue-600 hover:underline">{{ $membership->user->email }}</a></p>
                                </div>
                            </div>

                            {{-- Application Details --}}
                            <div>
                                <h3 class="admin-detail-heading">Application Details</h3>
                                <div class="admin-detail-group">
                                    <p class="admin-text-secondary"><strong>Membership Type:</strong> {{ $membership->membership_type }}</p>
                                    <p class="admin-text-secondary"><strong>Transaction ID:</strong> {{ $membership->transaction_id }}</p>
                                    <p class="admin-text-secondary"><strong>Payment Method:</strong> {{ $membership->payment_method }}</p>
                                    <p class="admin-text-secondary"><strong>Applied At:</strong> {{ $membership->applied_at->format('d M Y, H:i A') }}</p>
                                    <div class="mt-4">
                                        @php
                                            $statusColorClass = match($membership->status) {
                                                'pending' => 'status-2',
                                                'approved' => 'status-4',
                                                'rejected' => 'status-1',
                                                default => 'status-8',
                                            };
                                        @endphp
                                        <span class="admin-status-badge {{ $statusColorClass }}">{{ $membership->status }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Actions --}}
                @if ($membership->status === 'pending')
                    <div class="admin-card">
                        <div class="admin-card-body">
                            <div class="admin-form-container">
                                <header>
                                    <h3 class="admin-detail-heading">Actions</h3>
                                    <p class="admin-section-description">Approve or reject this membership application.</p>
                                </header>
                                <div class="admin-form-actions">
                                    <form action="{{ route('admin.memberships.approve', $membership) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="admin-button-base admin-button-purple">Approve</button>
                                    </form>
                                    <button type="button" class="admin-button-base admin-button-danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'reject-membership-{{ $membership->id }}')">
                                        Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

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
</x-app-layout>
