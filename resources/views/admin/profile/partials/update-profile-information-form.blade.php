<header>
    <h2 class="admin-detail-heading">
        {{ __('Profile Information') }}
    </h2>

    <p class="admin-section-description">
        {{ __("Update your account's profile information and email address.") }}
    </p>
</header>

<form method="post" action="{{ route('profile.update') }}" class="admin-form-vertical">
    @csrf
    @method('patch')

    <div class="admin-form-group">
        <label for="name" class="admin-form-label">{{ __('Name') }}</label>
        <input id="name" name="name" type="text" class="admin-form-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
        @error('name')
            <ul class="admin-input-error">
                @foreach ($errors->get('name') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="email" class="admin-form-label">{{ __('Email') }}</label>
        <input id="email" name="email" type="email" class="admin-form-input" value="{{ old('email', $user->email) }}" required autocomplete="username" />
        @error('email')
            <ul class="admin-input-error">
                @foreach ($errors->get('email') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="first_name" class="admin-form-label">{{ __('First Name') }}</label>
        <input id="first_name" name="first_name" type="text" class="admin-form-input" value="{{ old('first_name', $user->first_name) }}" autocomplete="given-name" />
        @error('first_name')
            <ul class="admin-input-error">
                @foreach ($errors->get('first_name') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="last_name" class="admin-form-label">{{ __('Last Name') }}</label>
        <input id="last_name" name="last_name" type="text" class="admin-form-input" value="{{ old('last_name', $user->last_name) }}" autocomplete="family-name" />
        @error('last_name')
            <ul class="admin-input-error">
                @foreach ($errors->get('last_name') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="phone_number" class="admin-form-label">{{ __('Phone Number') }}</label>
        <input id="phone_number" name="phone_number" type="text" class="admin-form-input" value="{{ old('phone_number', $user->phone_number) }}" autocomplete="tel" />
        @error('phone_number')
            <ul class="admin-input-error">
                @foreach ($errors->get('phone_number') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="date_of_birth" class="admin-form-label">{{ __('Date of Birth') }}</label>
        <input id="date_of_birth" name="date_of_birth" type="date" class="admin-form-input" value="{{ old('date_of_birth', $user->date_of_birth) }}" />
        @error('date_of_birth')
            <ul class="admin-input-error">
                @foreach ($errors->get('date_of_birth') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="blood_group" class="admin-form-label">{{ __('Blood Group') }}</label>
        <select id="blood_group" name="blood_group" class="admin-form-input">
            <option value="">{{ __('Select Blood Group') }}</option>
            @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $blood_group)
                <option value="{{ $blood_group }}" @selected(old('blood_group', $user->blood_group) == $blood_group)>
                    {{ $blood_group }}
                </option>
            @endforeach
        </select>
        @error('blood_group')
            <ul class="admin-input-error">
                @foreach ($errors->get('blood_group') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="current_city" class="admin-form-label">{{ __('Current City') }}</label>
        <input id="current_city" name="current_city" type="text" class="admin-form-input" value="{{ old('current_city', $user->current_city) }}" autocomplete="address-level2" />
        @error('current_city')
            <ul class="admin-input-error">
                @foreach ($errors->get('current_city') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="country" class="admin-form-label">{{ __('Country') }}</label>
        <input id="country" name="country" type="text" class="admin-form-input" value="{{ old('country', $user->country) }}" autocomplete="country-name" />
        @error('country')
            <ul class="admin-input-error">
                @foreach ($errors->get('country') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="department" class="admin-form-label">{{ __('Department') }}</label>
        <input id="department" name="department" type="text" class="admin-form-input" value="{{ old('department', $user->department) }}" />
        @error('department')
            <ul class="admin-input-error">
                @foreach ($errors->get('department') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="works_at" class="admin-form-label">{{ __('Works At') }}</label>
        <input id="works_at" name="works_at" type="text" class="admin-form-input" value="{{ old('works_at', $user->works_at) }}" />
        @error('works_at')
            <ul class="admin-input-error">
                @foreach ($errors->get('works_at') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="designation" class="admin-form-label">{{ __('Designation') }}</label>
        <input id="designation" name="designation" type="text" class="admin-form-input" value="{{ old('designation', $user->designation) }}" />
        @error('designation')
            <ul class="admin-input-error">
                @foreach ($errors->get('designation') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="bio" class="admin-form-label">{{ __('Bio') }}</label>
        <textarea id="bio" name="bio" class="admin-form-textarea" rows="4">{{ old('bio', $user->bio) }}</textarea>
        @error('bio')
            <ul class="admin-input-error">
                @foreach ($errors->get('bio') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="linkedin_url" class="admin-form-label">{{ __('LinkedIn URL') }}</label>
        <input id="linkedin_url" name="linkedin_url" type="text" class="admin-form-input" value="{{ old('linkedin_url', $user->linkedin_url) }}" />
        @error('linkedin_url')
            <ul class="admin-input-error">
                @foreach ($errors->get('linkedin_url') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="facebook_url" class="admin-form-label">{{ __('Facebook URL') }}</label>
        <input id="facebook_url" name="facebook_url" type="text" class="admin-form-input" value="{{ old('facebook_url', $user->facebook_url) }}" />
        @error('facebook_url')
            <ul class="admin-input-error">
                @foreach ($errors->get('facebook_url') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @enderror
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="admin-button-base admin-button-purple">{{ __('Save') }}</button>

        @if (session('status') === 'profile-updated')
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
