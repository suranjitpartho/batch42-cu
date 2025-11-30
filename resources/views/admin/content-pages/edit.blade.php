<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Edit Content Page') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                @if ($contentPage->slug === 'social-media-links')
                    {{-- Form for Social Media Links Page --}}
                    <div class="admin-card-body">
                        <form action="{{ route('admin.content-pages.update', $contentPage) }}" method="POST" class="admin-form-vertical">
                            @csrf
                            @method('PUT')

                            {{-- Hidden title fields to pass validation --}}
                            <input type="hidden" name="title_en" value="{{ $contentPage->getTranslation('title', 'en') }}">
                            <input type="hidden" name="title_bn" value="{{ $contentPage->getTranslation('title', 'bn') }}">

                            <div class="admin-form-group">
                                <label class="admin-form-label">Page Title</label>
                                <p class="admin-form-static-text">{{ $contentPage->getTranslation('title', 'en') }}</p>
                            </div>

                            {{-- Social Media Link Fields --}}
                            <div class="admin-form-group">
                                <label for="facebook_url" class="admin-form-label">Facebook URL</label>
                                <input type="url" id="facebook_url" name="social_links[facebook_url]" class="admin-form-input" value="{{ old('social_links.facebook_url', $socialLinks['facebook_url'] ?? '') }}">
                            </div>
                            <div class="admin-form-group">
                                <label for="twitter_url" class="admin-form-label">Twitter URL</label>
                                <input type="url" id="twitter_url" name="social_links[twitter_url]" class="admin-form-input" value="{{ old('social_links.twitter_url', $socialLinks['twitter_url'] ?? '') }}">
                            </div>
                            <div class="admin-form-group">
                                <label for="instagram_url" class="admin-form-label">Instagram URL</label>
                                <input type="url" id="instagram_url" name="social_links[instagram_url]" class="admin-form-input" value="{{ old('social_links.instagram_url', $socialLinks['instagram_url'] ?? '') }}">
                            </div>
                            <div class="admin-form-group">
                                <label for="linkedin_url" class="admin-form-label">LinkedIn URL</label>
                                <input type="url" id="linkedin_url" name="social_links[linkedin_url]" class="admin-form-input" value="{{ old('social_links.linkedin_url', $socialLinks['linkedin_url'] ?? '') }}">
                            </div>
                            <div class="admin-form-group">
                                <label for="youtube_url" class="admin-form-label">YouTube URL</label>
                                <input type="url" id="youtube_url" name="social_links[youtube_url]" class="admin-form-input" value="{{ old('social_links.youtube_url', $socialLinks['youtube_url'] ?? '') }}">
                            </div>

                            {{-- Shared Fields --}}
                            <div class="admin-form-group">
                                <label for="slug" class="admin-form-label">Slug</label>
                                <input type="text" id="slug" name="slug" class="admin-form-input" value="{{ old('slug', $contentPage->slug) }}" readonly>
                            </div>

                            <div class="admin-form-group">
                                <label class="admin-form-label">Published</label>
                                <div class="admin-checkbox-container">
                                    <input type="checkbox" id="is_published" name="is_published" value="1" class="admin-form-checkbox" {{ old('is_published', $contentPage->is_published) ? 'checked' : '' }}>
                                    <label for="is_published" class="admin-checkbox-label">Make this page publicly visible</label>
                                </div>
                            </div>

                            <div class="admin-form-actions">
                                <button type="submit" class="admin-button-base admin-button-purple">
                                    Update Content Page
                                </button>
                                <a href="{{ route('admin.content-pages.index') }}" class="admin-button-base admin-button-secondary">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                @elseif (in_array($contentPage->slug, ['president-message', 'secretary-message']))
                    {{-- Form for President/Secretary Message Pages --}}
                    <div class="admin-card-body" x-data="{ activeTab: 'en' }">
                        <div class="admin-tabs-container">
                            <div class="admin-tabs">
                                <button @click="activeTab = 'en'" :class="{'admin-tab-active': activeTab === 'en'}" class="admin-tab-item">English</button>
                                <button @click="activeTab = 'bn'" :class="{'admin-tab-active': activeTab === 'bn'}" class="admin-tab-item">Bengali</button>
                            </div>
                        </div>

                        <form action="{{ route('admin.content-pages.update', $contentPage) }}" method="POST" class="admin-form-vertical" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Hidden title fields --}}
                            <input type="hidden" name="title_en" value="{{ $contentPage->getTranslation('title', 'en') }}">
                            <input type="hidden" name="title_bn" value="{{ $contentPage->getTranslation('title', 'bn') }}">

                            {{-- English Fields --}}
                            <div x-show="activeTab === 'en'" class="admin-tab-content admin-form-vertical">
                                <div class="admin-form-group">
                                    <label for="title_en_display" class="admin-form-label">Title (English)</label>
                                    <input type="text" id="title_en_display" class="admin-form-input" value="{{ $contentPage->getTranslation('title', 'en') }}" readonly>
                                </div>
                                <div class="admin-form-group">
                                    <label for="name_en" class="admin-form-label">Name (English)</label>
                                    <input type="text" id="name_en" name="message_data[name_en]" class="admin-form-input" value="{{ old('message_data.name_en', $messageData['name_en'] ?? '') }}">
                                    <x-input-error class="mt-2" :messages="$errors->get('message_data.name_en')" />
                                </div>
                                <div class="admin-form-group">
                                    <label for="message_en" class="admin-form-label">Message (English)</label>
                                    <textarea id="message_en" name="message_data[message_en]" class="admin-form-textarea" rows="10">{{ old('message_data.message_en', $messageData['message_en'] ?? '') }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('message_data.message_en')" />
                                </div>
                            </div>

                            {{-- Bengali Fields --}}
                            <div x-show="activeTab === 'bn'" class="admin-tab-content admin-form-vertical" style="display: none;">
                                <div class="admin-form-group">
                                    <label for="title_bn_display" class="admin-form-label">Title (Bengali)</label>
                                    <input type="text" id="title_bn_display" class="admin-form-input" value="{{ $contentPage->getTranslation('title', 'bn') }}" readonly>
                                </div>
                                <div class="admin-form-group">
                                    <label for="name_bn" class="admin-form-label">Name (Bengali)</label>
                                    <input type="text" id="name_bn" name="message_data[name_bn]" class="admin-form-input" value="{{ old('message_data.name_bn', $messageData['name_bn'] ?? '') }}">
                                    <x-input-error class="mt-2" :messages="$errors->get('message_data.name_bn')" />
                                </div>
                                <div class="admin-form-group">
                                    <label for="message_bn" class="admin-form-label">Message (Bengali)</label>
                                    <textarea id="message_bn" name="message_data[message_bn]" class="admin-form-textarea" rows="10">{{ old('message_data.message_bn', $messageData['message_bn'] ?? '') }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('message_data.message_bn')" />
                                </div>
                            </div>

                            {{-- Shared Fields --}}
                            <div class="admin-form-group">
                                <label for="image" class="admin-form-label">Photo</label>
                                @if($contentPage->image_path)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $contentPage->image_path) }}" alt="Current Photo" class="w-32 h-32 object-cover rounded border border-gray-200">
                                    </div>
                                @endif
                                <input type="file" id="image" name="image" class="admin-form-input">
                                <p class="text-sm text-gray-500 mt-1">Recommended size: 300x300px. Max size: 2MB.</p>
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>

                            <div class="admin-form-group">
                                <label for="slug" class="admin-form-label">Slug</label>
                                <input type="text" id="slug" name="slug" class="admin-form-input" value="{{ old('slug', $contentPage->slug) }}" readonly>
                            </div>

                            <div class="admin-form-group">
                                <label class="admin-form-label">Published</label>
                                <div class="admin-checkbox-container">
                                    <input type="checkbox" id="is_published" name="is_published" value="1" class="admin-form-checkbox" {{ old('is_published', $contentPage->is_published) ? 'checked' : '' }}>
                                    <label for="is_published" class="admin-checkbox-label">Make this page publicly visible</label>
                                </div>
                            </div>

                            <div class="admin-form-actions">
                                <button type="submit" class="admin-button-base admin-button-purple">
                                    Update Content Page
                                </button>
                                <a href="{{ route('admin.content-pages.index') }}" class="admin-button-base admin-button-secondary">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                @else
                    {{-- Original Tabbed Form for Standard Content Pages --}}
                    <div class="admin-card-body" x-data="{ activeTab: 'en' }">
                        <div class="admin-tabs-container">
                            <div class="admin-tabs">
                                <button @click="activeTab = 'en'" :class="{'admin-tab-active': activeTab === 'en'}" class="admin-tab-item">English</button>
                                <button @click="activeTab = 'bn'" :class="{'admin-tab-active': activeTab === 'bn'}" class="admin-tab-item">Bengali</button>
                            </div>
                        </div>

                        <form action="{{ route('admin.content-pages.update', $contentPage) }}" method="POST" class="admin-form-vertical">
                            @csrf
                            @method('PUT')

                            {{-- English Fields --}}
                            <div x-show="activeTab === 'en'" class="admin-tab-content admin-form-vertical">
                                <div class="admin-form-group">
                                    <label for="title_en" class="admin-form-label">Title (English)</label>
                                    <input type="text" id="title_en" name="title_en" class="admin-form-input" value="{{ old('title_en', $contentPage->getTranslation('title', 'en')) }}" readonly>
                                </div>
                                <div class="admin-form-group">
                                    <label for="content_en" class="admin-form-label">Content (English)</label>
                                    <textarea id="content_en" name="content_en" class="admin-form-textarea">{{ old('content_en', $contentPage->getTranslation('content', 'en')) }}</textarea>
                                </div>
                            </div>

                            {{-- Bengali Fields --}}
                            <div x-show="activeTab === 'bn'" class="admin-tab-content admin-form-vertical" style="display: none;">
                                <div class="admin-form-group">
                                    <label for="title_bn" class="admin-form-label">Title (Bengali)</label>
                                    <input type="text" id="title_bn" name="title_bn" class="admin-form-input" value="{{ old('title_bn', $contentPage->getTranslation('title', 'bn')) }}" readonly>
                                </div>
                                <div class="admin-form-group">
                                    <label for="content_bn" class="admin-form-label">Content (Bengali)</label>
                                    <textarea id="content_bn" name="content_bn" class="admin-form-textarea">{{ old('content_bn', $contentPage->getTranslation('content', 'bn')) }}</textarea>
                                </div>
                            </div>

                            {{-- Shared Fields --}}
                            <div class="admin-form-group">
                                <label for="slug" class="admin-form-label">Slug</label>
                                <input type="text" id="slug" name="slug" class="admin-form-input" value="{{ old('slug', $contentPage->slug) }}" readonly>
                            </div>

                            <div class="admin-form-group">
                                <label class="admin-form-label">Published</label>
                                <div class="admin-checkbox-container">
                                    <input type="checkbox" id="is_published" name="is_published" value="1" class="admin-form-checkbox" {{ old('is_published', $contentPage->is_published) ? 'checked' : '' }}>
                                    <label for="is_published" class="admin-checkbox-label">Make this page publicly visible</label>
                                </div>
                            </div>

                            <div class="admin-form-actions">
                                <button type="submit" class="admin-button-base admin-button-purple">
                                    Update Content Page
                                </button>
                                <a href="{{ route('admin.content-pages.index') }}" class="admin-button-base admin-button-secondary">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>