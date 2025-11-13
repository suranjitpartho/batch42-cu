@if ($ad)
    <div x-data="{
        open: false,
        init() {
            if (!sessionStorage.getItem('lightboxShown')) {
                this.open = true;
                sessionStorage.setItem('lightboxShown', 'true');
            }
        }
    }" x-init="init()" x-show="open" x-cloak style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <!-- Overlay -->
        <div x-show="open" x-transition.opacity.duration.300ms class="fixed inset-0 bg-black/70"></div>

        <!-- Modal -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300ms"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200ms" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="relative z-10 w-full max-w-2xl overflow-hidden rounded-lg bg-white shadow-xl"
            @click.away="open = false">
            <!-- Close Button -->
            <button @click="open = false"
                class="absolute top-3 right-3 flex h-6 w-6 items-center justify-center rounded-md bg-black/50 text-white transition-colors hover:bg-black/70 focus:outline-none">
                <span class="sr-only">Close</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Ad Content -->
            <div>
                @if ($ad->link_url)
                    <a href="{{ $ad->link_url }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('storage/' . $ad->image_path) }}" alt="{{ $ad->title }}"
                            class="w-full h-auto object-contain">
                    </a>
                @else
                    <img src="{{ asset('storage/' . $ad->image_path) }}" alt="{{ $ad->title }}"
                        class="w-full h-auto object-contain">
                @endif
            </div>
        </div>
    </div>
@endif
