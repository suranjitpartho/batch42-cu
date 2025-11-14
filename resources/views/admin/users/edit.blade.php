<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form method="post" action="{{ route('admin.users.update', $user) }}" class="admin-form-vertical">
                        @csrf
                        @method('PUT')

                        <div class="admin-form-group">
                            <label for="name" class="admin-form-label">{{ __('Name') }}</label>
                            <input id="name" name="name" type="text" class="admin-form-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" disabled />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="email" class="admin-form-label">{{ __('Email') }}</label>
                            <input id="email" name="email" type="email" class="admin-form-input" value="{{ old('email', $user->email) }}" required autocomplete="username" disabled />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="status" class="admin-form-label">{{ __('Status') }}</label>
                            <select id="status" name="status" class="admin-form-input" {{ $user->email === config('auth.admin_email') ? 'disabled' : '' }}>
                                <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $user->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label">{{ __('Roles') }}</label>
                            <div class="admin-checkbox-grid">
                                @foreach($roles as $role)
                                    @if($role->name === 'admin')
                                        @if($user->email === config('auth.admin_email'))
                                            <label for="role_{{ $role->id }}" class="admin-checkbox-container">
                                                <input id="role_{{ $role->id }}" type="checkbox" class="admin-form-checkbox" name="roles[]" value="{{ $role->name }}" checked disabled>
                                                <span class="admin-checkbox-label">{{ $role->name }}</span>
                                            </label>
                                        @endif
                                    @else
                                        <label for="role_{{ $role->id }}" class="admin-checkbox-container">
                                            <input id="role_{{ $role->id }}" type="checkbox" class="admin-form-checkbox" name="roles[]" value="{{ $role->name }}" {{ in_array($role->name, $userRoles) ? 'checked' : '' }} {{ $user->email === config('auth.admin_email') ? 'disabled' : '' }}>
                                            <span class="admin-checkbox-label">{{ $role->name }}</span>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('roles')" />
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple" {{ $user->email === config('auth.admin_email') ? 'disabled' : '' }}>
                                {{ __('Update User') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
