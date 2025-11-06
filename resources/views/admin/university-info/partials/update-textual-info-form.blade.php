<div class="admin-card">
    <div class="admin-card-body">
        <form method="post" action="{{ route('admin.university-info.update.textual') }}" class="admin-form-vertical" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="form_section" value="textual_info">

            <header class="form-section-header">
                <h3 class="admin-detail-heading">Page Content</h3>
                <p class="admin-section-description">Update the textual content for the university and batch sections.</p>
            </header>

            <div class="admin-form-group">
                <label for="university_history" class="admin-form-label">{{ __('University History') }}</label>
                <textarea id="university_history" name="university_history" class="admin-form-textarea">{{ old('university_history', $info->university_history) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('university_history')" />
            </div>

            <div class="admin-form-group">
                <label for="university_mission" class="admin-form-label">{{ __('University Mission') }}</label>
                <textarea id="university_mission" name="university_mission" class="admin-form-textarea" rows="4">{{ old('university_mission', $info->university_mission) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('university_mission')" />
            </div>

            <div class="admin-form-group">
                <label for="university_vision" class="admin-form-label">{{ __('University Vision') }}</label>
                <input id="university_vision" name="university_vision" type="text" class="admin-form-input" value="{{ old('university_vision', $info->university_vision) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('university_vision')" />
            </div>

            <div class="admin-form-group">
                <label for="batch_info" class="admin-form-label">{{ __('Batch 42 Info') }}</label>
                <textarea id="batch_info" name="batch_info" class="admin-form-textarea">{{ old('batch_info', $info->batch_info) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('batch_info')" />
            </div>

            <div class="admin-form-actions">
                <button type="submit" class="admin-button-base admin-button-purple">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </form>
    </div>
</div>
