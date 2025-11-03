<header>
    <h2 class="admin-detail-heading">
        {{ __('Profile Photo') }}
    </h2>

    <p class="admin-section-description">
        {{ __('Update your profile photo.') }}
    </p>
</header>

<form method="post" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data" class="admin-form-vertical">
    @csrf
    @method('patch')

    <div class="admin-form-group">
        <!-- Current Profile Photo -->
        <div class="mb-4">
            <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/default-avatar.png') }}" alt="Profile Photo" class="w-24 h-24 rounded-full object-cover border border-gray-300">
        </div>

        <label for="photo" class="admin-form-label">{{ __('New Photo') }}</label>
        <input id="photo" name="photo" type="file" class="admin-form-input" />
        @error('photo')
            <ul class="admin-input-error">
                @foreach ($errors->get('photo') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="admin-button-base admin-button-purple">{{ __('Save') }}</button>

        @if ($user->profile_photo_path)
            <form method="post" action="{{ route('profile.photo.destroy') }}" class="inline">
                @csrf
                @method('delete')
                <button type="submit" class="admin-button-base admin-button-danger">{{ __('Remove Photo') }}</button>
            </form>
        @endif

        @if (session('status') === 'photo-updated' || session('status') === 'photo-deleted')
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
