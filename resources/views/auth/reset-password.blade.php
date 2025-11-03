<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="admin-form-label">{{ __('Email') }}</label>
            <input id="email" class="admin-form-input" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
            @error('email')
                <div class="admin-input-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group-mt">
            <label for="password" class="admin-form-label">{{ __('Password') }}</label>
            <input id="password" class="admin-form-input" type="password" name="password" required autocomplete="new-password" />
            @error('password')
                <div class="admin-input-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group-mt">
            <label for="password_confirmation" class="admin-form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" class="admin-form-input"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
                <div class="admin-input-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="admin-form-actions form-group-mt form-actions-justify">
            <button type="submit" class="admin-button-base admin-button-purple">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
