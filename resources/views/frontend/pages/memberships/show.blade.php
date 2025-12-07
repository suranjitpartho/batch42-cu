@extends('layouts.storefront')

@section('content')
    <div class="membership-container">
        <h1 class="membership-title">Alumni Membership Status</h1>

        @if ($membership)
            <div class="membership-status-box">
                <p><span class="font-semibold">Status:</span> {{ ucfirst($membership->status) }}</p>
                <p><span class="font-semibold">Applied At:</span> {{ $membership->applied_at->format('d M, Y H:i A') }}</p>

                @if ($membership->status === 'rejected')
                    <p class="text-red-600"><span class="font-semibold">Reason for Rejection:</span> {{ $membership->rejection_reason }}</p>
                    <a href="{{ route('membership.create', ['reapply' => true]) }}" class="btn-submit mt-4">Reapply for Membership</a>
                @endif
                <a href="{{ route('home') }}" class="btn-submit mt-4 ml-2">Back to Home</a>
            </div>
        @else
            <div class="membership-status-box">
                <p>You have not applied for alumni membership yet.</p>
                <a href="{{ route('membership.create') }}" class="btn-submit">Apply Now</a>
            </div>
        @endif
    </div>
@endsection
