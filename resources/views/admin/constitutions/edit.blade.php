<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Edit Constitution Chapter') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form method="post" action="{{ route('admin.constitutions.update', $constitution) }}" class="admin-form-vertical" x-data="{ activeTab: 'en' }">
                        @csrf
                        @method('PUT')

                        <div class="admin-form-group">
                            <label for="chapter_number" class="admin-form-label">{{ __('Chapter Number') }}</label>
                            <input id="chapter_number" name="chapter_number" type="text" class="admin-form-input" :value="old('chapter_number', $constitution->chapter_number)" placeholder="e.g. Chapter 1" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('chapter_number')" />
                        </div>

                        <div class="admin-tabs-container mb-6">
                            <div class="admin-tabs">
                                <button type="button" @click="activeTab = 'en'" :class="{'admin-tab-active': activeTab === 'en'}" class="admin-tab-item">English</button>
                                <button type="button" @click="activeTab = 'bn'" :class="{'admin-tab-active': activeTab === 'bn'}" class="admin-tab-item">Bengali</button>
                            </div>
                        </div>

                        {{-- English Fields --}}
                        <div x-show="activeTab === 'en'" class="admin-tab-content admin-form-vertical">
                            <div class="admin-form-group">
                                <label for="chapter_name_en" class="admin-form-label">{{ __('Chapter Name (English)') }}</label>
                                <input id="chapter_name_en" name="chapter_name_en" type="text" class="admin-form-input" :value="old('chapter_name_en', $constitution->getTranslation('chapter_name', 'en'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('chapter_name_en')" />
                            </div>

                            <div class="admin-form-group">
                                <label for="content_en" class="admin-form-label">{{ __('Content (English)') }}</label>
                                <textarea id="content_en" name="content_en" class="admin-form-input" rows="6" required>{{ old('content_en', $constitution->getTranslation('content', 'en')) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('content_en')" />
                            </div>
                        </div>

                        {{-- Bengali Fields --}}
                        <div x-show="activeTab === 'bn'" class="admin-tab-content admin-form-vertical" style="display: none;">
                            <div class="admin-form-group">
                                <label for="chapter_name_bn" class="admin-form-label">{{ __('Chapter Name (Bangla)') }}</label>
                                <input id="chapter_name_bn" name="chapter_name_bn" type="text" class="admin-form-input" :value="old('chapter_name_bn', $constitution->getTranslation('chapter_name', 'bn'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('chapter_name_bn')" />
                            </div>

                            <div class="admin-form-group">
                                <label for="content_bn" class="admin-form-label">{{ __('Content (Bangla)') }}</label>
                                <textarea id="content_bn" name="content_bn" class="admin-form-input" rows="6" required>{{ old('content_bn', $constitution->getTranslation('content', 'bn')) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('content_bn')" />
                            </div>
                        </div>

                        <div class="admin-form-group">
                            <label for="order" class="admin-form-label">{{ __('Order') }}</label>
                            <input id="order" name="order" type="number" class="admin-form-input" :value="old('order', $constitution->order)" />
                            <x-input-error class="mt-2" :messages="$errors->get('order')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="is_active" class="admin-checkbox-container">
                                <input id="is_active" type="checkbox" class="admin-form-checkbox" name="is_active" value="1" {{ old('is_active', $constitution->is_active) ? 'checked' : '' }}>
                                <span class="admin-checkbox-label">{{ __('Active') }}</span>
                            </label>
                            <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                {{ __('Update Chapter') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
