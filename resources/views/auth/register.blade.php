<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="admin-form-label">{{ __('Name') }}</label>
            <input id="name" class="admin-form-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @error('name')
                <div class="admin-input-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="form-group-mt">
            <label for="email" class="admin-form-label">{{ __('Email') }}</label>
            <input id="email" class="admin-form-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
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
                            required autocomplete="new-password" />
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
            <a class="admin-text-link" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="admin-button-base admin-button-purple">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
