<div class="admin-card">
    <div class="admin-card-body">
        <form method="post" action="{{ route('admin.university-info.update.batch-images') }}" class="admin-form-vertical" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="form_section" value="batch_images">

            <header class="form-section-header">
                <h3 class="admin-detail-heading">Batch 42 Images</h3>
                <p class="admin-section-description">Upload new images for the Batch 42 section.</p>
            </header>

            @php
                $batchImages = [
                    'batch_detail_photo_1_path' => 'Batch Photo 1',
                    'batch_detail_photo_2_path' => 'Batch Photo 2',
                    'batch_detail_photo_3_path' => 'Batch Photo 3',
                    'batch_detail_photo_4_path' => 'Batch Photo 4',
                    'batch_detail_photo_5_path' => 'Batch Photo 5',
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($batchImages as $field => $label)
                    <div class="admin-form-group">
                        <label for="{{ $field }}" class="admin-form-label">{{ $label }}</label>

                        @if ($info->{$field})
                            <div class="relative inline-block mt-2 mb-2">
                                <img src="{{ asset('storage/' . $info->{$field}) }}" alt="{{ $label }}" class="max-w-xs h-auto rounded-lg shadow-md">
                                <button type="button" class="admin-image-delete-button absolute top-0 right-0 -mt-2 -mr-2" onclick="deleteImage('{{ route('admin.university-info.image.destroy', ['field' => $field]) }}')">
                                    <i class="fa-solid fa-times"></i>
                                </button>
                            </div>
                        @endif

                        <input id="{{ $field }}" name="{{ $field }}" type="file" class="admin-form-input" />
                        <x-input-error class="mt-2" :messages="$errors->get($field)" />
                    </div>
                @endforeach
            </div>

            <div class="admin-form-actions">
                <button type="submit" class="admin-button-base admin-button-purple">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function deleteImage(url) {
        if (confirm('Are you sure you want to delete this image?')) {
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    alert('Failed to delete image.');
                }
            });
        }
    }
</script>
@endpush
