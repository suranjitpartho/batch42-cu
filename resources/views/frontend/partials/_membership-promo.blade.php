<section class="relative py-10 bg-fe-primary overflow-hidden group">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <svg class="absolute top-0 left-0 w-full h-full" width="100%" height="100%">
            <pattern id="promo-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                <circle cx="2" cy="2" r="2" class="text-fe-accent" fill="currentColor" />
                <circle cx="22" cy="22" r="2" class="text-fe-accent" fill="currentColor" />
            </pattern>
            <rect x="0" y="0" width="100%" height="100%" fill="url(#promo-pattern)" />
        </svg>
    </div>
    
    <!-- Decorative Blobs -->
    <div class="absolute -top-24 -left-24 w-64 h-64 bg-fe-secondary/20 rounded-full blur-3xl group-hover:bg-fe-secondary/30 transition-all duration-700"></div>
    <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-fe-primary-dark/20 rounded-full blur-3xl group-hover:bg-fe-primary-dark/30 transition-all duration-700"></div>

    <div class="relative container mx-auto px-4 text-center z-10">
        <!-- Icon -->
        <div class="inline-flex items-center justify-center w-16 h-16 mb-4 rounded-full bg-white/10 backdrop-blur-md shadow-[0_8px_32px_0_rgba(75,56,62,0.37)] ring-1 ring-white/20 text-white text-2xl animate-[bounce_3s_infinite]">
            <i class="fa-solid fa-people-roof drop-shadow-md"></i>
        </div>

        <!-- Text -->
        <h2 class="text-2xl md:text-4xl font-bold text-white mb-3 tracking-tight drop-shadow-sm">
            Become a Part of Our <span class="relative inline-block">
                Alumni Community
                <svg class="absolute w-full h-2 -bottom-1 left-0 text-fe-secondary opacity-90" viewBox="0 0 100 10" preserveAspectRatio="none">
                    <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="3" fill="none" />
                </svg>
            </span>
        </h2>
        <p class="text-base md:text-lg text-fe-accent/90 mb-6 max-w-2xl mx-auto leading-relaxed font-medium">
            Register for your alumni membership today and connect with fellow graduates. Unlock exclusive benefits and stay in touch!
        </p>

        <!-- Button -->
        <a href="{{ route('membership.create') }}" 
           class="group/btn relative inline-flex items-center gap-3 px-8 py-3 bg-fe-secondary text-white text-base font-medium rounded-full shadow-lg shadow-fe-primary-dark/20 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
            
            {{-- Button Shine Effect --}}
            <div class="absolute top-0 -left-[100%] w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent skew-x-[25deg] transition-all duration-1000 group-hover/btn:left-[100%]"></div>
            
            <span class="relative">Register Now</span>
            <i class="fa-solid fa-arrow-right relative transition-transform duration-300 group-hover/btn:translate-x-1"></i>
        </a>
    </div>
</section>
