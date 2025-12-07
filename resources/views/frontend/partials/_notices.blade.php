<section class="py-20 bg-fe-accent relative overflow-hidden" x-data="{ 
    videoOpen: false, 
    currentVideoId: '',
    playVideo(id) {
        this.currentVideoId = id;
        this.videoOpen = true;
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    },
    closeVideo() {
        this.videoOpen = false;
        this.currentVideoId = '';
        document.body.style.overflow = ''; // Restore scrolling
    }
}">
    <!-- Decorative Background Elements -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-fe-secondary/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-fe-primary/5 rounded-full blur-3xl translate-x-1/3 translate-y-1/3"></div>

    <div class="container mx-auto px-6 md:px-12 lg:px-24 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
            
            <!-- Left Column: Notices (5 cols) -->
            <div class="lg:col-span-5 flex flex-col h-full">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-fe-primary-dark font-sans tracking-tight">
                            Latest Notices
                        </h2>
                        <div class="mt-2">
                            <svg width="120" height="12" viewBox="0 0 120 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 9C25 11 75 11 117 3" stroke="#e9ae9a" stroke-width="4" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                    @if($showAllNoticesButton)
                        <a href="{{ route('notices.index') }}" class="group flex items-center gap-2 text-fe-spacegrey hover:text-fe-primary transition-colors text-sm font-medium">
                            <span>View Archive</span>
                            <span class="w-8 h-8 rounded-full bg-white border border-fe-light-border flex items-center justify-center group-hover:bg-fe-primary group-hover:border-fe-primary group-hover:text-white transition-all duration-300 shadow-sm">
                                <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-0.5 transition-transform"></i>
                            </span>
                        </a>
                    @endif
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 px-4">
                    @forelse ($notices as $index => $notice)
                        <a href="{{ route('notices.show', $notice) }}" 
                           class="group block relative bg-white p-6 pt-8 shadow-[1px_2px_8px_rgba(0,0,0,0.08)] hover:shadow-[2px_15px_30px_rgba(0,0,0,0.15)] transition-all duration-300 transform hover:scale-105 hover:z-10 {{ $index % 2 == 0 ? '-rotate-2' : 'rotate-2 translate-y-6' }} hover:rotate-0 max-w-sm mx-auto w-full">
                            
                            <!-- Pin Visual -->
                            <div class="absolute -top-2.5 left-1/2 transform -translate-x-1/2 z-10">
                                <div class="w-4 h-4 rounded-full bg-gradient-to-br from-fe-primary to-fe-primary-dark shadow-sm border-2 border-white"></div>
                            </div>
                            
                            <div class="flex flex-col items-center text-center h-full">
                                <!-- Date -->
                                <div class="mb-3">
                                    <span class="text-xs font-bold text-fe-secondary uppercase tracking-widest border-b border-fe-secondary/20 pb-0.5">
                                        {{ $notice->created_at->format('d M Y') }}
                                    </span>
                                </div>
                                
                                <!-- Title -->
                                <h3 class="text-base font-bold text-fe-spaceblack group-hover:text-fe-primary transition-colors line-clamp-3 mb-3 font-sans leading-snug flex-grow">
                                    {{ $notice->title }}
                                </h3>
                                
                                <!-- Excerpt -->
                                <p class="text-xs text-fe-spacegrey line-clamp-3 leading-relaxed mb-4">
                                    {{ strip_tags($notice->content) }}
                                </p>
                                
                                <!-- Members Only Badge -->
                                @if($notice->members_only)
                                    <div class="mt-auto inline-flex items-center gap-1 px-2 py-0.5 rounded-sm bg-fe-secondary/10 text-fe-secondary text-[10px] font-bold uppercase tracking-wider">
                                        <i class="fa-solid fa-lock text-[8px]"></i> Members Only
                                    </div>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full bg-white/50 backdrop-blur-sm rounded-2xl p-8 text-center border border-dashed border-fe-primary/30">
                            <div class="w-16 h-16 bg-fe-accent rounded-full flex items-center justify-center mx-auto mb-4 text-fe-primary/50">
                                <i class="fa-regular fa-folder-open text-2xl"></i>
                            </div>
                            <p class="text-fe-spacegrey font-medium">No notices published yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right Column: Video Gallery (7 cols) -->
            <div class="lg:col-span-7 flex flex-col h-full mt-12 lg:mt-0 pl-0 lg:pl-8 border-l-0 lg:border-l border-fe-secondary/30">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-fe-primary-dark font-sans tracking-tight">
                            Video Gallery
                        </h2>
                        <div class="mt-2">
                            <svg width="120" height="12" viewBox="0 0 120 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 9C25 11 75 11 117 3" stroke="#e9ae9a" stroke-width="4" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('video_gallery.index') }}" class="group flex items-center gap-2 text-fe-spacegrey hover:text-fe-secondary transition-colors text-sm font-medium">
                        <span>Watch All</span>
                        <span class="w-8 h-8 rounded-full bg-white border border-fe-light-border flex items-center justify-center group-hover:bg-fe-secondary group-hover:border-fe-secondary group-hover:text-white transition-all duration-300 shadow-sm">
                            <i class="fa-solid fa-play text-xs ml-0.5 transform group-hover:scale-110 transition-transform"></i>
                        </span>
                    </a>
                </div>

                <!-- Featured & List Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">
                    @if($videos->count() > 0)
                        <!-- Featured Video (Left - 40%) -->
                        @php $featuredVideo = $videos->first(); @endphp
                        <div class="lg:col-span-2 group relative bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md border border-transparent hover:border-fe-secondary/20 transition-all duration-300 cursor-pointer h-full flex flex-col"
                             @click="playVideo('{{ $featuredVideo->video_id }}')">
                            
                            <!-- Thumbnail -->
                            <div class="relative w-full aspect-video overflow-hidden">
                                <img src="https://img.youtube.com/vi/{{ $featuredVideo->video_id }}/hqdefault.jpg" 
                                     alt="{{ $featuredVideo->title }}" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                                     onerror="this.src='https://img.youtube.com/vi/{{ $featuredVideo->video_id }}/mqdefault.jpg'">
                                
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-black/30 transition-colors duration-300"></div>
                                
                                <!-- Play Button -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-fe-secondary shadow-lg transform scale-90 group-hover:scale-110 transition-all duration-300">
                                        <i class="fa-solid fa-play text-lg ml-1"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4 flex flex-col flex-grow">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-fe-primary/10 text-fe-primary uppercase tracking-wider">Featured</span>
                                    <span class="text-[10px] text-fe-spacegrey flex items-center gap-1">
                                        <i class="fa-regular fa-clock text-[9px]"></i> {{ $featuredVideo->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <h3 class="text-base font-bold text-fe-spaceblack group-hover:text-fe-primary transition-colors line-clamp-2 mb-2 font-sans leading-tight">
                                    {{ $featuredVideo->title }}
                                </h3>
                                <p class="text-xs text-fe-spacegrey line-clamp-3 leading-relaxed">
                                    {{ $featuredVideo->description }}
                                </p>
                            </div>
                        </div>

                        <!-- Side Videos (Right - 60%) -->
                        <div class="lg:col-span-3 flex flex-col gap-3">
                            @foreach($videos->skip(1) as $video)
                                <div class="group relative bg-white rounded-xl p-2 shadow-sm hover:shadow-md border border-transparent hover:border-fe-secondary/20 transition-all duration-300 cursor-pointer flex items-center gap-3 overflow-hidden h-full"
                                     @click="playVideo('{{ $video->video_id }}')">
                                    
                                    <!-- Thumbnail -->
                                    <div class="relative w-40 md:w-48 aspect-video flex-shrink-0 rounded-lg overflow-hidden shadow-sm">
                                        <img src="https://img.youtube.com/vi/{{ $video->video_id }}/mqdefault.jpg" 
                                             alt="{{ $video->title }}" 
                                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                             onerror="this.src='https://img.youtube.com/vi/{{ $video->video_id }}/hqdefault.jpg'">
                                        
                                        <!-- Play Overlay -->
                                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors duration-300 flex items-center justify-center">
                                            <div class="w-8 h-8 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-fe-secondary shadow-lg transform scale-90 group-hover:scale-110 transition-all duration-300">
                                                <i class="fa-solid fa-play text-xs ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-grow min-w-0 py-0.5">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="text-[10px] text-fe-spacegrey flex items-center gap-1 bg-fe-background px-2 py-0.5 rounded-full">
                                                <i class="fa-regular fa-clock text-[9px]"></i> {{ $video->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <h3 class="text-sm font-bold text-fe-spaceblack group-hover:text-fe-primary transition-colors line-clamp-1 mb-1 font-sans leading-snug">
                                            {{ $video->title }}
                                        </h3>
                                        <p class="text-xs text-fe-spacegrey line-clamp-2 leading-relaxed">{{ $video->description }}</p>
                                    </div>
                                    
                                    <!-- Arrow -->
                                    <div class="hidden md:flex flex-shrink-0 w-6 h-6 rounded-full border border-fe-light-border text-fe-light-border items-center justify-center group-hover:border-fe-secondary group-hover:text-fe-secondary transition-all duration-300 transform group-hover:translate-x-1 mr-1">
                                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="col-span-full bg-white/50 backdrop-blur-sm rounded-2xl p-12 text-center border border-dashed border-fe-secondary/30 flex flex-col items-center justify-center min-h-[200px]">
                            <div class="w-16 h-16 bg-fe-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4 text-fe-secondary">
                                <i class="fa-solid fa-film text-2xl"></i>
                            </div>
                            <p class="text-fe-spacegrey">No videos available yet.</p>
                        </div>
                    @endif
                </div>
            </div>
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
</section>