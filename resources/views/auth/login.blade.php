<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="admin-text-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="admin-form-label">{{ __('Email') }}</label>
            <input id="email" class="admin-form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email')
                <div class="admin-input-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group-mt">
            <label for="password" class="admin-form-label">{{ __('Password') }}</label>
            <input id="password" class="admin-form-input"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            @error('password')
                <div class="admin-input-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-group-mt">
            <label for="remember_me" class="admin-checkbox-container">
                <input id="remember_me" type="checkbox" class="admin-form-checkbox" name="remember">
                <span class="admin-checkbox-label">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="admin-form-actions form-group-mt form-actions-justify">
            <div class="link-group">
                @if (Route::has('password.request'))
                    <a class="admin-text-link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <a class="admin-text-link" href="{{ route('register') }}">
                    {{ __('Not registered yet?') }}
                </a>
            </div>

            <button type="submit" class="admin-button-base admin-button-purple">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
