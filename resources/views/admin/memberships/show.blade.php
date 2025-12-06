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
                                <div class="admin-detail-group flex flex-col gap-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $membership->user->profile_photo_path ? asset('storage/' . $membership->user->profile_photo_path) : asset('images/default-avatar.svg') }}" alt="{{ $membership->user->name }}" class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                                        <div>
                                            <p class="text-lg font-semibold text-gray-900">{{ $membership->user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $membership->user->email }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase font-semibold">Faculty</p>
                                            <p class="text-gray-900">{{ $membership->user->faculty }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase font-semibold">Department</p>
                                            <p class="text-gray-900">{{ $membership->user->department }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase font-semibold">Phone Number</p>
                                            <p class="text-gray-900">{{ $membership->user->phone_number }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase font-semibold">Home District</p>
                                            <p class="text-gray-900">{{ $membership->user->home_district ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase font-semibold">Current City</p>
                                            <p class="text-gray-900">{{ $membership->user->current_city ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Application Details --}}
                            <div>
                                <h3 class="admin-detail-heading">Application Details</h3>
                                <div class="admin-detail-group">
                                    <p class="admin-text-secondary"><strong>Applied At:</strong> {{ $membership->applied_at->format('d M Y, H:i A') }}</p>
                                    
                                    {{-- Certificate Section --}}
                                    @if($membership->certificate_path)
                                        <div class="mt-4">
                                            <p class="text-xs text-gray-500 uppercase font-semibold mb-2">Certificate</p>
                                            <a href="{{ asset('storage/' . $membership->certificate_path) }}" 
                                               target="_blank" 
                                               class="admin-button-base admin-button-black inline-flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View Certificate (PDF)
                                            </a>
                                        </div>
                                    @else
                                        <div class="mt-4">
                                            <p class="text-xs text-gray-500 uppercase font-semibold mb-2">Certificate</p>
                                            <p class="text-gray-400 italic">No certificate uploaded</p>
                                        </div>
                                    @endif
                                    
                                    <div class="mt-4">
                                        @php
                                            $statusColorClass = match($membership->status) {
                                                'pending' => 'status-2',
                                                'approved' => 'status-4',
                                                'rejected' => 'status-1',
                                                default => 'status-8',
                                            };
                                        @endphp
                                        <span class="admin-status-badge {{ $statusColorClass }}">{{ ucfirst($membership->status) }}</span>
                                    </div>
                                    @if($membership->status === 'rejected')
                                        <div class="mt-4 p-4 bg-red-50 rounded-md border border-red-100">
                                            <p class="text-red-800 font-semibold text-sm">Rejection Reason:</p>
                                            <p class="text-red-600 mt-1">{{ $membership->rejection_reason }}</p>
                                        </div>
                                    @endif
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
