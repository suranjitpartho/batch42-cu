<header class="form-section-header">
    <h2 class="admin-detail-heading">
        {{ __('Update Password') }}
    </h2>

    <p class="admin-section-description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>
</header>

<form method="post" action="{{ route('password.update') }}" class="admin-form-vertical">
    @csrf
    @method('put')

    <div class="admin-form-group">
        <label for="update_password_current_password" class="admin-form-label">{{ __('Current Password') }}</label>
        <input id="update_password_current_password" name="current_password" type="password" class="admin-form-input" autocomplete="current-password" />
        @error('current_password', 'updatePassword')
            <ul class="admin-input-error">
                @foreach ($errors->updatePassword->get('current_password') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="update_password_password" class="admin-form-label">{{ __('New Password') }}</label>
        <input id="update_password_password" name="password" type="password" class="admin-form-input" autocomplete="new-password" />
        @error('password', 'updatePassword')
            <ul class="admin-input-error">
                @foreach ($errors->updatePassword->get('password') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="update_password_password_confirmation" class="admin-form-label">{{ __('Confirm Password') }}</label>
        <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="admin-form-input" autocomplete="new-password" />
        @error('password_confirmation', 'updatePassword')
            <ul class="admin-input-error">
                @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="admin-button-base admin-button-purple">{{ __('Save') }}</button>
        @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="admin-text-secondary"
            >{{ __('Saved.') }}</p>
        @endif
    </div>
</form>
