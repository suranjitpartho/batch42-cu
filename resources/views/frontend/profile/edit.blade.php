@extends('layouts.storefront')

@section('content')
<div class="profile-edit-container">
    <div class="profile-edit-header">
        <h1>Edit Profile</h1>
        <p>Manage your account settings and profile information.</p>
    </div>

    <div class="profile-edit-content">
        <!-- Profile Photo Section -->
        <div class="profile-card">
            <h2>Profile Photo</h2>
            <div class="profile-photo-area">
                <div class="photo-preview-container">
                    <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/default-avatar.svg') }}" alt="{{ $user->name }}" class="photo-preview" id="photo-preview">
                </div>
                <div class="photo-upload-actions">
                    <form method="POST" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data" class="upload-form">
                        @csrf
                        @method('patch')
                        <label for="photo" class="btn-secondary">
                            <i class="fa-solid fa-upload"></i> Choose a photo
                        </label>
                        <input type="file" id="photo" name="photo" class="hidden-file-input" accept="image/*">
                        <span id="file-name-display" class="file-name-display">No file selected</span>
                        <button type="submit" class="btn-primary">
                            <i class="fa-solid fa-save"></i> Save Photo
                        </button>
                        @error('photo')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </form>
                    @if ($user->profile_photo_path)
                        <div class="delete-form-container">
                            <button 
                                type="button" 
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-photo-deletion')"
                                class="btn-danger-outline"
                            >
                                <i class="fa-solid fa-trash"></i> Delete Photo
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <x-modal name="confirm-photo-deletion" focusable>
            <form method="post" action="{{ route('profile.photo.destroy') }}" class="p-6" style="padding: 1.5rem;">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900" style="font-size: 1.25rem; font-weight: 600; color: var(--spaceblack);">
                    Are you sure you want to delete your profile photo?
                </h2>

                <p class="mt-1 text-sm text-gray-600" style="margin-top: 0.5rem; font-size: 0.875rem; color: var(--spacegrey);">
                    Once your photo is deleted, it cannot be recovered.
                </p>

                <div class="mt-6 flex justify-end" style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3">
                        {{ __('Delete Photo') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>

        <!-- Profile Information Section -->
        <div class="profile-card">
            <h2>Profile Information</h2>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="form-grid">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- First Name -->
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}">
                        @error('first_name')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                        @error('last_name')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                        @error('phone_number')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}">
                        @error('date_of_birth')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Blood Group -->
                    <div class="form-group">
                        <label for="blood_group">Blood Group</label>
                        <input type="text" id="blood_group" name="blood_group" value="{{ old('blood_group', $user->blood_group) }}">
                        @error('blood_group')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Current City -->
                    <div class="form-group">
                        <label for="current_city">Current City</label>
                        <input type="text" id="current_city" name="current_city" value="{{ old('current_city', $user->current_city) }}">
                        @error('current_city')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" id="country" name="country" value="{{ old('country', $user->country) }}">
                        @error('country')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Department -->
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" id="department" name="department" value="{{ old('department', $user->department) }}">
                        @error('department')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Works At -->
                    <div class="form-group">
                        <label for="works_at">Works At</label>
                        <input type="text" id="works_at" name="works_at" value="{{ old('works_at', $user->works_at) }}">
                        @error('works_at')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Designation -->
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <input type="text" id="designation" name="designation" value="{{ old('designation', $user->designation) }}">
                        @error('designation')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- LinkedIn URL -->
                    <div class="form-group form-group-full">
                        <label for="linkedin_url">LinkedIn Profile</label>
                        <input type="url" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $user->linkedin_url) }}">
                        @error('linkedin_url')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Facebook URL -->
                    <div class="form-group form-group-full">
                        <label for="facebook_url">Facebook Profile</label>
                        <input type="url" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $user->facebook_url) }}">
                        @error('facebook_url')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Bio -->
                    <div class="form-group form-group-full">
                        <label for="bio">Bio</label>
                        <textarea id="bio" name="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Save Changes</button>
                </div>
            </form>
        </div>

        <!-- Update Password Section -->
        <div class="profile-card">
            <h2>Update Password</h2>
            <form method="POST" action="{{ route('profile.password.update') }}">
                @csrf
                @method('put')

                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" required>
                    @error('current_password', 'updatePassword')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password', 'updatePassword')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Save Password</button>
                </div>
            </form>
        </div>

        <!-- Delete Account Section -->
        <div class="profile-card danger-zone">
            <h2>Delete Account</h2>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
            
            <div class="form-actions">
                <button 
                    type="button" 
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    class="btn-danger"
                >
                    Delete Account
                </button>
            </div>
        </div>

        <x-modal name="confirm-user-deletion" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6" style="padding: 1.5rem;">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium" style="font-size: 1.25rem; font-weight: 600; color: var(--spaceblack);">
                    Are you sure you want to delete your account?
                </h2>

                <p class="mt-1 text-sm" style="margin-top: 0.5rem; font-size: 0.875rem; color: var(--spacegrey);">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="mt-6" style="margin-top: 1.5rem;">
                    <label for="password-modal" class="sr-only">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password-modal" 
                        class="form-control" 
                        placeholder="Password"
                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ccc; border-radius: 6px;"
                    >
                    @error('password', 'userDeletion')
                        <span class="form-error" style="display: block; margin-top: 0.5rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end" style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3">
                        {{ __('Delete Account') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.getElementById('photo');
        const fileNameDisplay = document.getElementById('file-name-display');
        const photoPreview = document.getElementById('photo-preview');

        if (photoInput) {
            photoInput.addEventListener('change', () => {
                if (photoInput.files.length > 0) {
                    const file = photoInput.files[0];
                    if (fileNameDisplay) {
                        fileNameDisplay.textContent = file.name;
                    }
                    
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        if (photoPreview) {
                            photoPreview.src = e.target.result;
                        }
                    };
                    reader.readAsDataURL(file);
                } else {
                    if (fileNameDisplay) {
                        fileNameDisplay.textContent = 'No file selected';
                    }
                }
            });
        }
    });
</script>
@endsection
