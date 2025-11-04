<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Edit Notice') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form action="{{ route('admin.notices.update', $notice) }}" method="POST" class="admin-form-vertical">
                        @csrf
                        @method('PUT')
                        
                        {{-- Title --}}
                        <div class="admin-form-group">
                            <label for="title" class="admin-form-label">Title</label>
                            <input type="text" id="title" name="title" class="admin-form-input" value="{{ old('title', $notice->title) }}" required>
                            @error('title')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Content --}}
                        <div class="admin-form-group">
                            <label for="content" class="admin-form-label">Content</label>
                            <textarea id="content" name="content" class="admin-form-textarea" required>{{ old('content', $notice->content) }}</textarea>
                            @error('content')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Members Only --}}
                        <div class="admin-form-group">
                            <label class="admin-form-label">Members Only</label>
                            <div class="admin-checkbox-container">
                                <input type="checkbox" id="members_only" name="members_only" value="1" class="admin-form-checkbox" {{ old('members_only', $notice->members_only) ? 'checked' : '' }}>
                                <label for="members_only" class="admin-checkbox-label">This notice is for members only</label>
                            </div>
                            @error('members_only')
                                <p class="admin-input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                Update Notice
                            </button>
                            <a href="{{ route('admin.notices.index') }}" class="admin-button-base admin-button-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>