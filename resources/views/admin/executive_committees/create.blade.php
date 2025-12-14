<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Upload Executive Committee') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form method="post" action="{{ route('admin.executive-committees.store') }}" class="admin-form-vertical" enctype="multipart/form-data">
                        @csrf

                        <div class="admin-form-group">
                            <label for="year" class="admin-form-label">{{ __('Select Year') }}</label>
                            <select id="year" name="year" class="admin-form-input" required>
                                @foreach($availableYears as $year)
                                    <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('year')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="document" class="admin-form-label">{{ __('Committee PDF Document') }}</label>
                            <input id="document" name="document" type="file" accept=".pdf" class="admin-form-input" required />
                            <p class="mt-1 text-sm text-gray-500">Only PDF files are allowed. Max size: 10MB.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('document')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="is_active" class="admin-checkbox-container">
                                <input id="is_active" type="checkbox" class="admin-form-checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="admin-checkbox-label">{{ __('Active (Visible on Website)') }}</span>
                            </label>
                            <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                {{ __('Upload Committee') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
