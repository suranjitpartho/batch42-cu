@if ($ads->isNotEmpty())
<div class="py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-center text-lg font-normal text-gray-400 mb-8">
            Our Sponsors
        </h3>
        <div class="flex flex-wrap items-center justify-center gap-x-8 gap-y-8 md:gap-x-12">
            @foreach ($ads as $ad)
                <a href="{{ $ad->link_url ?? '#' }}" 
                   @if($ad->link_url) target="_blank" rel="noopener noreferrer" @endif
                   class="block"
                   title="{{ $ad->title }}">
                    <img class="h-16 object-contain transition-transform duration-300 hover:scale-110" 
                         src="{{ asset('storage/' . $ad->image_path) }}" 
                         alt="{{ $ad->title }}">
                </a>
            @endforeach
        </div>
    </div>
</div>
@endif
