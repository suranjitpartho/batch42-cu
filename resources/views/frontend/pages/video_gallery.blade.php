@extends('layouts.storefront')

@section('title', 'Video Gallery')

@section('content')
<div class="bg-fe-accent/30 min-h-screen py-20 relative overflow-hidden" x-data="{ 
    videoOpen: false, 
    currentVideoId: '',
    playVideo(id) {
        this.currentVideoId = id;
        this.videoOpen = true;
        document.body.style.overflow = 'hidden';
    },
    closeVideo() {
        this.videoOpen = false;
        this.currentVideoId = '';
        document.body.style.overflow = '';
    }
}">
    <!-- Decorative Background Elements -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-fe-secondary/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-fe-primary/5 rounded-full blur-3xl translate-x-1/3 translate-y-1/3"></div>

    <div class="container mx-auto px-6 md:px-12 lg:px-24 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-fe-primary-dark font-sans tracking-tight mb-4">
                Video Gallery
            </h1>
            <div class="flex justify-center mb-6">
                <svg width="150" height="15" viewBox="0 0 150 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 12C30 14 90 14 147 3" stroke="#e9ae9a" stroke-width="5" stroke-linecap="round"/>
                </svg>
            </div>
            <p class="text-fe-spacegrey text-lg max-w-2xl mx-auto leading-relaxed">
                Explore our collection of videos capturing memorable moments and activities.
            </p>
        </div>

        <!-- Video Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($videos as $video)
                <div class="group relative bg-white rounded-2xl overflow-hidden shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] hover:shadow-[0_15px_30px_-5px_rgba(0,0,0,0.1)] transition-all duration-300 transform hover:-translate-y-2 cursor-pointer border border-transparent hover:border-fe-secondary/20"
                     @click="playVideo('{{ $video->video_id }}')">
                    
                    <!-- Thumbnail -->
                    <div class="relative aspect-video overflow-hidden">
                        <img src="https://img.youtube.com/vi/{{ $video->video_id }}/mqdefault.jpg" 
                             alt="{{ $video->title }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                             onerror="this.src='https://img.youtube.com/vi/{{ $video->video_id }}/hqdefault.jpg'">
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors duration-300"></div>
                        
                        <!-- Play Button -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-14 h-14 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-fe-secondary shadow-lg transform scale-90 group-hover:scale-110 transition-all duration-300 group-hover:bg-fe-secondary group-hover:text-white">
                                <i class="fa-solid fa-play text-xl ml-1"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold bg-fe-primary/10 text-fe-primary uppercase tracking-wider">Video</span>
                            <span class="text-xs text-fe-spacegrey flex items-center gap-1">
                                <i class="fa-regular fa-clock text-[10px]"></i> {{ $video->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-fe-spaceblack group-hover:text-fe-primary transition-colors line-clamp-2 mb-3 font-sans leading-tight">
                            {{ $video->title }}
                        </h3>
                        @if($video->description)
                            <p class="text-sm text-fe-spacegrey line-clamp-3 leading-relaxed">
                                {{ $video->description }}
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white/50 backdrop-blur-sm rounded-3xl p-16 text-center border border-dashed border-fe-secondary/30">
                    <div class="w-24 h-24 bg-fe-secondary/10 rounded-full flex items-center justify-center mx-auto mb-6 text-fe-secondary">
                        <i class="fa-solid fa-film text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-fe-primary-dark mb-3">Gallery Empty</h3>
                    <p class="text-fe-spacegrey text-lg">Stay tuned! We will be uploading videos soon.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-16 flex justify-center">
            {{ $videos->links() }}
        </div>
    </div>

    <!-- Alpine.js Video Modal -->
    <div x-show="videoOpen" 
         style="display: none;"
         class="fixed inset-0 z-[9999] flex items-center justify-center px-4 md:px-6"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/90 backdrop-blur-lg" @click="closeVideo()"></div>

        <!-- Modal Content -->
        <div class="relative w-full max-w-5xl bg-black rounded-2xl overflow-hidden shadow-2xl ring-1 ring-white/10"
             x-show="videoOpen"
             x-transition:enter="transition ease-out duration-300 delay-100"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4">
            
            <!-- Close Button -->
            <button @click="closeVideo()" 
                    class="absolute top-4 right-4 z-50 w-10 h-10 rounded-full bg-black/50 text-white/70 hover:text-white hover:bg-fe-primary transition-all duration-300 backdrop-blur-md border border-white/10 flex items-center justify-center group">
                <i class="fa-solid fa-xmark text-lg transform group-hover:rotate-90 transition-transform duration-300"></i>
            </button>

            <!-- Video Container -->
            <div class="aspect-video w-full bg-black">
                <template x-if="videoOpen">
                    <iframe :src="'https://www.youtube.com/embed/' + currentVideoId + '?autoplay=1&rel=0&modestbranding=1&showinfo=0'" 
                            title="YouTube video player" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                            class="w-full h-full">
                    </iframe>
                </template>
            </div>
        </div>
    </div>
</div>
@endsection
