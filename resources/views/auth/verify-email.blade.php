<x-guest-layout>
    <div class="text-description">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="admin-text-success text-description">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="admin-form-actions form-group-mt form-actions-justify">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            @if (isset($email))
                <input type="hidden" name="email" value="{{ $email }}">
                <div class="form-group">
                    <p class="text-description">A new verification link will be sent to <strong>{{ $email }}</strong>.</p>
                </div>
            @else
                <div class="form-group">
                    <label for="email" class="admin-form-label">{{ __('Email') }}</label>
                    <input id="email" class="admin-form-input" type="email" name="email" value="{{ old('email') }}" required autofocus />
                </div>
            @endif

            <div>
                <button type="submit" class="admin-button-base admin-button-purple">
                    {{ __('Resend Verification Email') }}
                </button>
            </div>
        </form>

        <!-- <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="admin-text-link">
                {{ __('Log Out') }}
            </button>
        </form> -->
    </div>
</x-guest-layout>
