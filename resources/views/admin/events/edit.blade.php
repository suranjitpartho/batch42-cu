<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form method="post" action="{{ route('admin.events.update', $event) }}" class="admin-form-vertical" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="admin-form-group">
                            <label for="title" class="admin-form-label">{{ __('Title') }}</label>
                            <input id="title" name="title" type="text" class="admin-form-input" value="{{ old('title', $event->title) }}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="description" class="admin-form-label">{{ __('Description') }}</label>
                            <textarea id="description" name="description" class="admin-form-input" rows="4">{{ old('description', $event->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="date" class="admin-form-label">{{ __('Date') }}</label>
                            <input id="date" name="date" type="datetime-local" class="admin-form-input" value="{{ old('date', $event->date) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('date')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="location" class="admin-form-label">{{ __('Location') }}</label>
                            <input id="location" name="location" type="text" class="admin-form-input" value="{{ old('location', $event->location) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>

                        <div class="admin-form-group">
                            <label for="images" class="admin-form-label">{{ __('Add More Images') }}</label>
                            <input id="images" name="images[]" type="file" class="admin-form-input" multiple />
                            <x-input-error class="mt-2" :messages="$errors->get('images')" />
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-checkbox-container">
                                <input id="is_published" type="checkbox" class="admin-form-checkbox" name="is_published" value="1" {{ old('is_published', $event->is_published) ? 'checked' : '' }}>
                                <span class="admin-checkbox-label">{{ __('Published') }}</span>
                            </label>
                            <x-input-error class="mt-2" :messages="$errors->get('is_published')" />
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                {{ __('Update Event') }}
                            </button>
                        </div>
                    </form>

                    <div class="admin-delete-section">
                        <h3 class="admin-detail-heading">{{ __('Existing Images') }}</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                            @foreach ($event->images as $image)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Event Image" class="w-full h-auto rounded-lg">
                                    <form action="{{ route('admin.events.images.destroy', [$event, $image]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-image-delete-button absolute top-0 right-0 -mt-2 -mr-2" onclick="return confirm('Are you sure you want to delete this image?')">
                                            <i class="fa-solid fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
