<section class="pt-12 pb-20 bg-[#f8f9fa] relative overflow-hidden" x-data="{ hover: null }">
    {{-- Abstract Background Illustration --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <svg class="absolute top-0 left-0 w-full h-full opacity-[0.03]" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 0 L100 0 L100 100 L0 100 Z" fill="#ffffff"/>
            <path d="M0 100 C 20 0 50 0 100 100 Z" fill="currentColor" class="text-fe-primary"/>
        </svg>


        
        {{-- Floating Doodles --}}
        <div class="absolute top-20 left-10 text-fe-primary/20 animate-bounce duration-[3000ms]">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="currentColor"><circle cx="20" cy="20" r="10"/></svg>
        </div>
        <div class="absolute bottom-20 right-10 text-fe-secondary/40" style="animation: spin 20s linear infinite;">
            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M10 10 L50 50 M50 10 L10 50"/>
            </svg>
        </div>
        <style>
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
        </style>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8 items-center">
            
            {{-- University Card --}}
            <div class="relative group" @mouseenter="hover = 'uni'" @mouseleave="hover = null">
                {{-- Card Shape --}}
                <div class="relative bg-white rounded-[2rem] md:rounded-[3rem] p-6 md:p-10 overflow-hidden transition-all duration-500 border-2 border-transparent hover:border-fe-primary/20 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_30px_70px_-15px_rgba(0,0,0,0.1)]">
                    
                    {{-- Background Blob --}}
                    <div class="absolute -right-20 -top-20 w-80 h-80 bg-fe-primary/5 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
                    
                    {{-- Content --}}
                    <div class="relative z-10">
                        <div class="flex items-start justify-between mb-8">
                            <div class="relative">
                                <div class="w-20 h-20 md:w-24 md:h-24 bg-white rounded-2xl shadow-sm border border-fe-light-border p-2 flex items-center justify-center relative z-10 group-hover:-rotate-6 transition-transform duration-300">
                                    <img src="{{ asset('images/logo-uni.png') }}" alt="University Logo" class="w-full h-full object-contain">
                                </div>
                                {{-- Doodle behind icon --}}
                                <div class="absolute -top-4 -left-4 text-fe-primary/30 -z-0">
                                    <svg width="60" height="60" viewBox="0 0 100 100" fill="currentColor">
                                        <path d="M30.8,-23.6C38.6,-14.8,42.8,-2.6,40.3,8.3C37.8,19.2,28.6,28.8,17.6,33.8C6.6,38.8,-6.2,39.2,-17.1,34.8C-28,30.4,-37,21.2,-40.3,9.8C-43.6,-1.6,-41.2,-15.2,-33.1,-24.1C-25,-33,-11.2,-37.2,0.9,-37.9C13,-38.6,23,-32.4,30.8,-23.6Z" transform="translate(50 50)" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute top-4 right-4 w-12 h-12 md:top-8 md:right-8 md:w-16 md:h-16 transition-transform duration-500 group-hover:scale-110 opacity-20 text-fe-primary flex items-center justify-center">
                            <i class="fas fa-university text-2xl md:text-3xl"></i>
                        </div>

                        <h2 class="text-2xl md:text-3xl font-bold text-fe-spaceblack font-bengali mb-2 md:mb-4 group-hover:text-fe-primary transition-colors duration-300">University of Chittagong</h2>
                        
                        <p class="text-fe-spacegrey text-base leading-relaxed mb-4 md:mb-8 line-clamp-3 relative">
                            <span class="absolute -left-4 top-0 w-1 h-full bg-fe-primary/20 rounded-full"></span>
                            {{ $info->university_history ?? 'The University of Chittagong is a public research university located in Hathazari, Chittagong, Bangladesh.' }}
                        </p>

                        <div class="flex items-center justify-between mt-auto pt-3 border-t border-dashed border-fe-light-border">
                            <span class="text-sm font-semibold text-fe-primary uppercase tracking-wider">Est. 1966</span>
                            <a href="{{ route('university.show') }}" class="group/btn flex items-center gap-3 text-fe-spaceblack font-bold hover:text-fe-primary transition-colors duration-300">
                                <span class="relative">
                                    Discover
                                    <svg class="absolute -bottom-1 left-0 w-full h-2 text-fe-primary/30 group-hover/btn:text-fe-primary/60 transition-colors duration-300" viewBox="0 0 100 10" preserveAspectRatio="none">
                                        <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="3" fill="none" />
                                    </svg>
                                </span>
                                <div class="w-8 h-8 rounded-full bg-fe-primary/10 flex items-center justify-center group-hover/btn:bg-fe-primary group-hover/btn:text-white transition-all duration-300">
                                    <i class="fas fa-arrow-right text-sm"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Batch Card --}}
            <div class="relative group lg:mt-0" @mouseenter="hover = 'batch'" @mouseleave="hover = null">
                {{-- Card Shape --}}
                <div class="relative bg-white rounded-[2rem] md:rounded-[3rem] p-6 md:p-10 overflow-hidden transition-all duration-500 border-2 border-transparent hover:border-fe-secondary/20 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_30px_70px_-15px_rgba(0,0,0,0.1)] transform lg:translate-y-8">
                    
                    {{-- Background Blob --}}
                    <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-fe-secondary/5 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>

                    {{-- Content --}}
                    <div class="relative z-10">
                        <div class="flex items-start justify-between mb-8">
                            <div class="relative">
                                <div class="w-20 h-20 md:w-24 md:h-24 bg-white rounded-2xl shadow-sm border border-fe-light-border p-2 flex items-center justify-center relative z-10 group-hover:rotate-6 transition-transform duration-300">
                                    <img src="{{ asset('images/logo.png') }}" alt="Batch Logo" class="w-full h-full object-contain">
                                </div>
                                {{-- Doodle behind icon --}}
                                <div class="absolute -top-4 -right-4 text-fe-secondary/30 -z-0 rotate-90">
                                    <svg width="60" height="60" viewBox="0 0 100 100" fill="currentColor">
                                        <rect x="10" y="10" width="80" height="80" rx="20" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="absolute top-4 right-4 w-12 h-12 md:top-8 md:right-8 md:w-16 md:h-16 transition-transform duration-500 group-hover:scale-110 opacity-20 text-fe-secondary flex items-center justify-center">
                            <i class="fas fa-users text-2xl md:text-3xl"></i>
                        </div>

                        <h2 class="text-2xl md:text-3xl font-bold text-fe-spaceblack font-bengali mb-2 md:mb-4 group-hover:text-fe-secondary transition-colors duration-300">Batch 42 (2006-2007)</h2>
                        
                        <p class="text-fe-spacegrey text-base leading-relaxed mb-4 md:mb-8 line-clamp-3 relative">
                            <span class="absolute -left-4 top-0 w-1 h-full bg-fe-secondary/20 rounded-full"></span>
                            {{ $info->batch_info ?? 'Batch 42 represents the students of the 2006-2007 session, a vibrant community of alumni.' }}
                        </p>

                        <div class="flex items-center justify-between mt-auto pt-3 border-t border-dashed border-fe-light-border">
                            <span class="text-sm font-semibold text-fe-secondary uppercase tracking-wider">Session 06-07</span>
                            <a href="{{ route('batch.show') }}" class="group/btn flex items-center gap-3 text-fe-spaceblack font-bold hover:text-fe-secondary transition-colors duration-300">
                                <span class="relative">
                                    Explore
                                    <svg class="absolute -bottom-1 left-0 w-full h-2 text-fe-secondary/30 group-hover/btn:text-fe-secondary/60 transition-colors duration-300" viewBox="0 0 100 10" preserveAspectRatio="none">
                                        <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="3" fill="none" />
                                    </svg>
                                </span>
                                <div class="w-8 h-8 rounded-full bg-fe-secondary/10 flex items-center justify-center group-hover/btn:bg-fe-secondary group-hover/btn:text-white transition-all duration-300">
                                    <i class="fas fa-arrow-right text-sm"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- Unstructured Dashed Wave Overlay --}}
    {{-- Desktop: Left to Right --}}
    <svg class="hidden md:block absolute top-0 left-0 w-full h-full opacity-15 z-20 pointer-events-none" viewBox="0 0 1440 800" preserveAspectRatio="none">
        <path d="M-100,400 C250,100 450,700 800,400 C1150,100 1350,700 1600,400" 
              fill="none" 
              stroke="currentColor" 
              stroke-width="3" 
              stroke-dasharray="15 15" 
              class="text-fe-primary"
              stroke-linecap="round"/>
    </svg>

    {{-- Mobile: Top-Left to Bottom-Right --}}
    <svg class="md:hidden absolute top-0 left-0 w-full h-full opacity-15 z-20 pointer-events-none" viewBox="0 0 400 800" preserveAspectRatio="none">
        <path d="M-50,50 C200,200 0,600 450,750" 
              fill="none" 
              stroke="currentColor" 
              stroke-width="3" 
              stroke-dasharray="15 15" 
              class="text-fe-primary"
              stroke-linecap="round"/>
    </svg>
</section>
