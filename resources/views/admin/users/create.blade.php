<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form method="post" action="{{ route('admin.users.store') }}" class="admin-form-vertical">
                        @csrf

                        <div class="admin-form-group">
                            <label for="name" class="admin-form-label">{{ __('Name') }}</label>
                            <input id="name" name="name" type="text" class="admin-form-input" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="email" class="admin-form-label">{{ __('Email') }}</label>
                            <input id="email" name="email" type="email" class="admin-form-input" :value="old('email')" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="password" class="admin-form-label">{{ __('Password') }}</label>
                            <input id="password" name="password" type="password" class="admin-form-input" required autocomplete="new-password" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="password_confirmation" class="admin-form-label">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="admin-form-input" required autocomplete="new-password" />
                            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label">{{ __('Roles') }}</label>
                            <div class="admin-checkbox-grid">
                                @foreach($roles->where('name', '!=', 'admin') as $role)
                                    <label for="role_{{ $role->id }}" class="admin-checkbox-container">
                                        <input id="role_{{ $role->id }}" type="checkbox" class="admin-form-checkbox" name="roles[]" value="{{ $role->name }}">
                                        <span class="admin-checkbox-label">{{ $role->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('roles')" />
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                {{ __('Create User') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
