<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Create Event') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form method="post" action="{{ route('admin.events.store') }}" class="admin-form-vertical" enctype="multipart/form-data">
                        @csrf

                        <div class="admin-form-group">
                            <label for="title" class="admin-form-label">{{ __('Title') }}</label>
                            <input id="title" name="title" type="text" class="admin-form-input" :value="old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="description" class="admin-form-label">{{ __('Description') }}</label>
                            <textarea id="description" name="description" class="admin-form-input" rows="4">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="date" class="admin-form-label">{{ __('Date') }}</label>
                            <input id="date" name="date" type="datetime-local" class="admin-form-input" :value="old('date')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('date')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="location" class="admin-form-label">{{ __('Location') }}</label>
                            <input id="location" name="location" type="text" class="admin-form-input" :value="old('location')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="images" class="admin-form-label">{{ __('Images') }}</label>
                            <input id="images" name="images[]" type="file" class="admin-form-input" multiple />
                            <x-input-error class="mt-2" :messages="$errors->get('images')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="is_published" class="admin-checkbox-container">
                                <input id="is_published" type="checkbox" class="admin-form-checkbox" name="is_published" value="1">
                                <span class="admin-checkbox-label">{{ __('Published') }}</span>
                            </label>
                            <x-input-error class="mt-2" :messages="$errors->get('is_published')" />
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                {{ __('Create Event') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
