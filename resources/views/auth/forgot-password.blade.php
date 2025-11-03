<x-guest-layout>
    <div class="text-description">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="admin-text-success text-description" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="admin-form-label">{{ __('Email') }}</label>
            <input id="email" class="admin-form-input" type="email" name="email" value="{{ old('email') }}" required autofocus />
            @error('email')
                <div class="admin-input-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="admin-form-actions form-group-mt form-actions-justify">
            <button type="submit" class="admin-button-base admin-button-purple">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
</x-guest-layout>
