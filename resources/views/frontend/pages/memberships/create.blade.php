@extends('layouts.storefront')

@section('content')
    <div class="membership-container">
        <h1 class="membership-title">Alumni Membership Application</h1>

        <form action="{{ route('membership.store') }}" method="POST" class="membership-form">
            @csrf

            <div class="form-group">
                <label for="membership_type" class="form-label">Membership Type</label>
                <select name="membership_type" id="membership_type" class="form-control">
                    <option value="general">General</option>
                    <option value="lifetime">Lifetime</option>
                </select>
            </div>

            <div class="form-group">
                <label for="transaction_id" class="form-label">Transaction ID</label>
                <input type="text" name="transaction_id" id="transaction_id" class="form-control">
            </div>

            <div class="form-group">
                <label for="payment_method" class="form-label">Payment Method</label>
                <input type="text" name="payment_method" id="payment_method" class="form-control">
            </div>

            <button type="submit" class="btn-submit">Submit Application</button>
        </form>
    </div>
@endsection