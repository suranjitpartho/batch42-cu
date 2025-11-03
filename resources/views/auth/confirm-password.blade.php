<x-guest-layout>
    <div class="text-description">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="admin-form-label">{{ __('Password') }}</label>
            <input id="password" class="admin-form-input"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            @error('password')
                <div class="admin-input-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="admin-form-actions form-group-mt form-actions-justify">
            <button type="submit" class="admin-button-base admin-button-purple">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</x-guest-layout>
