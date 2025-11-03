<header class="form-section-header">
    <h2 class="admin-detail-heading">
        {{ __('Delete Account') }}
    </h2>

    <p class="admin-section-description">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </p>
</header>

<div>
    <button
        type="button"
        class="admin-button-base admin-button-danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</button>
</div>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="modal-form admin-form-vertical">
        @csrf
        @method('delete')

        <h2 class="admin-detail-heading">
            {{ __('Are you sure you want to delete your account?') }}
        </h2>

        <p class="admin-section-description">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
        </p>

        <div class="admin-form-group">
            <label for="password" class="admin-form-label sr-only">{{ __('Password') }}</label>

            <input
                id="password"
                name="password"
                type="password"
                class="admin-form-input delete-form-password-input"
                placeholder="{{ __('Password') }}"
            />

            @error('password', 'userDeletion')
                <ul class="admin-input-error">
                    @foreach ($errors->userDeletion->get('password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @enderror
        </div>

        <div class="admin-form-actions">
            <button type="button" class="admin-button-base admin-button-secondary" x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </button>

            <button type="submit" class="admin-button-base admin-button-danger">
                {{ __('Delete Account') }}
            </button>
        </div>
    </form>
</x-modal>
