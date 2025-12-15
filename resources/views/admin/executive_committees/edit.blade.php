<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Edit Executive Committee') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form method="post" action="{{ route('admin.executive-committees.update', $executiveCommittee) }}" class="admin-form-vertical" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="admin-form-group">
                            <label for="year" class="admin-form-label">{{ __('Select Year') }}</label>
                            <select id="year" name="year" class="admin-form-input" required>
                                <option value="{{ $executiveCommittee->year }}" selected>{{ $executiveCommittee->year }}</option>
                                @foreach($availableYears as $year)
                                    @if($year !== $executiveCommittee->year)
                                        <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('year')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="document" class="admin-form-label">{{ __('Update Document (Optional)') }}</label>
                            <input id="document" name="document" type="file" accept=".pdf" class="admin-form-input" />
                            <p class="mt-1 text-sm text-gray-500">Upload new PDF to replace the existing one. Max size: 10MB.</p>
                            
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $executiveCommittee->document_path) }}" target="_blank" class="text-blue-600 hover:underline text-sm"> <i class="fa-regular fa-file-pdf mr-1"></i> View Current Document</a>
                            </div>

                            <x-input-error class="mt-2" :messages="$errors->get('document')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="is_active" class="admin-checkbox-container">
                                <input id="is_active" type="checkbox" class="admin-form-checkbox" name="is_active" value="1" {{ old('is_active', $executiveCommittee->is_active) ? 'checked' : '' }}>
                                <span class="admin-checkbox-label">{{ __('Active (Visible on Website)') }}</span>
                            </label>
                            <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                {{ __('Update Committee') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
