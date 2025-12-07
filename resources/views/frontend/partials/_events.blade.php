<section class="relative py-12 bg-fe-background overflow-hidden" x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 200)">
    <!-- Decorative Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] -left-[5%] w-[40rem] h-[40rem] bg-fe-primary/5 rounded-full blur-3xl mix-blend-multiply animate-blob"></div>
        <div class="absolute top-[20%] -right-[5%] w-[35rem] h-[35rem] bg-fe-secondary/5 rounded-full blur-3xl mix-blend-multiply animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[45rem] h-[45rem] bg-fe-accent/30 rounded-full blur-3xl mix-blend-multiply animate-blob animation-delay-4000"></div>
    </div>

    <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header (Restored) -->
        <div class="text-center max-w-3xl mx-auto mb-10">
            <h2 class="inline-block text-sm font-bold tracking-widest text-fe-primary uppercase mb-3 bg-fe-primary/10 px-4 py-1.5 rounded-full"
                x-show="shown"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0">
                Recent Updates
            </h2>
            <h3 class="text-4xl md:text-5xl font-bold text-fe-primary-dark mb-6 tracking-tight leading-tight"
                x-show="shown"
                x-transition:enter="transition ease-out duration-700 delay-100"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0">
                Moments & <span class="text-transparent bg-clip-text bg-gradient-to-r from-fe-primary to-fe-secondary">Gatherings</span>
            </h3>
            <p class="text-lg text-fe-spacegrey leading-relaxed"
               x-show="shown"
               x-transition:enter="transition ease-out duration-700 delay-200"
               x-transition:enter-start="opacity-0 translate-y-4"
               x-transition:enter-end="opacity-100 translate-y-0">
                Explore the latest highlights from our community. Stay connected with our journey through these captured memories.
            </p>
        </div>

        <!-- Events Grid (4 Columns) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-16">
            @foreach ($events as $event)
                <div class="group relative flex flex-col {{ $loop->index >= 3 ? 'hidden sm:flex' : '' }}" 
                     x-show="shown"
                     style="transition-delay: {{ 300 + ($loop->index * 100) }}ms"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 translate-y-8"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    
                    <a href="{{ route('events.show', $event->slug) }}" class="flex flex-col h-full">
                        <!-- Scattered Images Container -->
                        <div class="relative h-64 w-full mb-6 perspective-1000">
                            <!-- Back Image (Rotated Left) -->
                            @if($event->images->count() > 1)
                                <div class="absolute inset-0 transform -rotate-6 scale-95 opacity-0 group-hover:opacity-100 transition-all duration-500 ease-out origin-bottom-left z-0">
                                    <img src="{{ Storage::url($event->images->get(1)->image_path) }}" 
                                         class="w-full h-full object-cover rounded-2xl shadow-md border-4 border-white">
                                </div>
                            @endif

                            <!-- Back Image (Rotated Right) -->
                            @if($event->images->count() > 2)
                                <div class="absolute inset-0 transform rotate-6 scale-95 opacity-0 group-hover:opacity-100 transition-all duration-500 ease-out origin-bottom-right z-0">
                                    <img src="{{ Storage::url($event->images->get(2)->image_path) }}" 
                                         class="w-full h-full object-cover rounded-2xl shadow-md border-4 border-white">
                                </div>
                            @endif

                            <!-- Main Image (Front) -->
                            <div class="absolute inset-0 z-10 transform transition-transform duration-500 group-hover:-translate-y-2">
                                @if($event->images->count() > 0)
                                    <img src="{{ Storage::url($event->images->first()->image_path) }}" 
                                         alt="{{ $event->title }}" 
                                         class="w-full h-full object-cover rounded-2xl shadow-lg group-hover:shadow-xl border-4 border-white/50 group-hover:border-white transition-all duration-300">
                                @else
                                    <div class="w-full h-full bg-fe-background-dark rounded-2xl flex items-center justify-center text-fe-primary-light border-4 border-white/50">
                                        <i class="fa-solid fa-image text-5xl opacity-50"></i>
                                    </div>
                                @endif
                                
                                <!-- Date Badge (Overlapping) -->
                                <div class="absolute -bottom-4 right-4 bg-white rounded-xl p-2 shadow-lg border border-fe-light-border flex flex-col items-center min-w-[3.5rem] z-20 group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-[10px] font-bold text-fe-spacegrey uppercase tracking-wider">{{ $event->date->format('M') }}</span>
                                    <span class="text-xl font-extrabold text-fe-primary">{{ $event->date->format('d') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="flex flex-col flex-grow px-2">
                            <div class="flex items-center gap-2 text-xs font-medium text-fe-primary mb-2">
                                <span class="bg-fe-primary/10 px-2 py-1 rounded-md">
                                    <i class="fa-solid fa-map-pin mr-1"></i> {{ Str::limit($event->location, 20) }}
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-fe-primary-dark mb-2 line-clamp-2 group-hover:text-fe-primary transition-colors duration-300">
                                {{ $event->title }}
                            </h3>
                            
                            <div class="mt-auto pt-3 border-t border-dashed border-fe-light-border flex items-center justify-between text-sm text-fe-spacegrey">
                                <span class="group-hover:text-fe-primary-dark transition-colors">Read Details</span>
                                <i class="fa-solid fa-arrow-right transform -translate-x-2 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-300 text-fe-primary"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Section Footer -->
        <div class="mt-10 text-center"
             x-show="shown"
             x-transition:enter="transition ease-out duration-700 delay-700"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0">
            @if($showAllEventsButton)
                <a href="{{ route('events.index') }}" 
                   class="group inline-flex items-center gap-3 px-8 py-3 border border-fe-primary-dark text-fe-primary-dark rounded-full text-sm font-semibold tracking-wide hover:text-fe-primary transition-all duration-300">
                    <span>Browse All Events</span>
                    <i class="fa-solid fa-arrow-right transition-transform duration-300 group-hover:translate-x-1"></i>
                </a>
            @endif
        </div>
    </div>
    
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</section>
