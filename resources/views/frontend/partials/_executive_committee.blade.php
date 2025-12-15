@if($executiveCommittee)
<section class="py-8 bg-fe-background relative overflow-hidden" x-data="{ showPdfModal: false }">
    {{-- Decorative background elements --}}
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] right-[-5%] w-[40rem] h-[40rem] bg-fe-primary/5 rounded-full blur-3xl mix-blend-multiply"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[40rem] h-[40rem] bg-fe-secondary/5 rounded-full blur-3xl mix-blend-multiply"></div>
        <div class="absolute top-[20%] left-[10%] w-72 h-72 bg-purple-100/30 rounded-full blur-2xl mix-blend-multiply"></div>
        <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03]"></div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Main 'Glass' Card -->
        <div class="relative w-full rounded-[2.5rem] bg-white/60 backdrop-blur-xl border border-white/60 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] overflow-hidden group hover:shadow-[0_40px_80px_-20px_rgba(0,0,0,0.15)] transition-all duration-500">
            
            <!-- Abstract Artistic Shapes -->
            <div class="absolute top-0 right-0 w-[30rem] h-[30rem] bg-gradient-to-br from-fe-secondary/10 to-fe-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-[25rem] h-[25rem] bg-gradient-to-tr from-fe-accent to-transparent rounded-full blur-3xl translate-y-1/3 -translate-x-1/4 pointer-events-none"></div>
            
            <!-- Giant Watermark Year -->
            <div class="absolute -right-12 -bottom-16 text-[12rem] leading-none font-bold text-fe-spaceblack/5 font-sans select-none pointer-events-none z-0 transform rotate-[-5deg] transition-transform duration-700 group-hover:rotate-0 group-hover:scale-105">
                {{ substr($executiveCommittee->year, 0, 4) }}
            </div>

            <div class="relative z-10 flex flex-col md:flex-row items-center md:items-stretch group-hover:bg-white/30 transition-colors duration-500">
                
                <!-- Left: Content content -->
                <div class="flex-1 p-8 md:p-12 space-y-6">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <span class="h-px w-8 bg-fe-primary"></span>
                            <span class="text-xs font-bold tracking-[0.2em] text-fe-primary uppercase">Leadership</span>
                        </div>
                        
                        <h2 class="text-3xl md:text-5xl font-bold text-fe-spaceblack tracking-tight leading-none">
                            Executive Committee <span class="text-transparent bg-clip-text bg-gradient-to-r from-fe-primary to-fe-secondary-light">& Advisory Panel</span>
                        </h2>
                        <div class="flex items-center gap-4 pt-2">
                             <div class="h-0.5 w-12 bg-fe-secondary/30 rounded-full"></div>
                             <span class="text-xl md:text-2xl font-light text-fe-spacegrey tracking-widest font-sans">{{ $executiveCommittee->year }}</span>
                             <div class="h-0.5 w-12 bg-fe-secondary/30 rounded-full"></div>
                        </div>
                    </div>

                    <p class="text-fe-spacegrey/80 text-lg max-w-md leading-relaxed border-l-2 border-fe-accent pl-4">
                        The guiding visionaries steering our community towards a brighter future.
                    </p>
                </div>

                <!-- Right: Action Area -->
                <div class="flex flex-col justify-between items-center md:items-end p-8 md:p-12 w-full md:w-1/3 border-t md:border-t-0 md:border-l border-white/50 bg-gradient-to-b from-white/20 to-transparent">
                    <div class="hidden md:block text-right">
                         <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white shadow-sm text-fe-primary mb-2">
                            <i class="fas fa-crown"></i>
                         </div>
                    </div>
                    
                    <div class="flex flex-col items-center md:items-end gap-3">
                        <button @click="showPdfModal = true" 
                            class="group/btn relative inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-fe-primary to-fe-primary-light text-white text-base font-semibold shadow-md shadow-fe-primary/30 overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-fe-primary/40 hover:-translate-y-0.5">
                            
                            {{-- Button Shine Effect --}}
                            <div class="absolute top-0 -left-[100%] w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent skew-x-[25deg] transition-all duration-1000 group-hover/btn:left-[100%]"></div>
                            
                            <div class="relative bg-white/20 p-1.5 rounded-full">
                                <i class="fas fa-file-pdf text-lg"></i>
                            </div>
                            <span class="relative">View Members</span>
                        </button>
                        <span class="text-xs text-fe-spacegrey/60 font-medium tracking-wide uppercase">Discover Team</span>
                    </div>
                </div>

            </div>
            
            <!-- Bottom Link Bar -->
            <div class="relative z-10 bg-white/40 border-t border-white/60 px-8 py-3 flex flex-col md:flex-row justify-between items-center text-xs font-medium text-fe-spacegrey/60 backdrop-blur-sm gap-2 md:gap-0">
                <div class="flex items-center gap-2">
                    <i class="fas fa-file-pdf text-fe-danger/70"></i>
                    <span>Official Document</span>
                </div>
                
                <a href="{{ route('executive-committees.index') }}" class="hover:text-fe-primary transition-colors flex items-center gap-1.5 group/link">
                    <span>View All Past Committees</span>
                    <i class="fas fa-arrow-right text-[10px] transition-transform duration-300 group-hover/link:translate-x-0.5"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- PDF Modal --}}
    <div x-show="showPdfModal" 
        style="display: none;"
        class="fixed inset-0 z-[100] overflow-y-auto" 
        role="dialog" 
        aria-modal="true">
        
        {{-- Backdrop --}}
        <div x-show="showPdfModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-fe-spaceblack/80 backdrop-blur-sm transition-opacity" 
            @click="showPdfModal = false"></div>

        <div class="flex min-h-screen items-center justify-center p-4">
            <div x-show="showPdfModal"
                x-transition:enter="ease-out duration-500"
                x-transition:enter-start="opacity-0 scale-90 translate-y-8"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-90 translate-y-8"
                class="relative w-full max-w-6xl h-[85vh] bg-white rounded-3xl shadow-2xl flex flex-col overflow-hidden">
                
                {{-- Modal Header --}}
                <div class="px-8 py-5 bg-white border-b border-fe-light-border flex justify-between items-center z-20">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-fe-accent flex items-center justify-center text-fe-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-fe-primary-dark">Executive Committee {{ $executiveCommittee->year }}</h3>
                            <p class="text-sm text-fe-spacegrey">Official Document Preview</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <a href="{{ asset('storage/' . $executiveCommittee->document_path) }}" 
                           download
                           class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-full bg-fe-background text-fe-primary-dark text-sm font-semibold hover:bg-fe-accent transition-colors">
                            <i class="fas fa-download"></i> Download
                        </a>
                        <button @click="showPdfModal = false" class="w-10 h-10 rounded-full bg-fe-background flex items-center justify-center text-fe-spacegrey hover:bg-fe-danger hover:text-white transition-all duration-300">
                            <i class="fas fa-xmark text-lg"></i>
                        </button>
                    </div>
                </div>
                
                {{-- Modal Content --}}
                <div class="flex-1 relative bg-fe-background/50">
                    <iframe src="{{ asset('storage/' . $executiveCommittee->document_path) }}" class="w-full h-full absolute inset-0" frameborder="0">
                        <div class="flex flex-col items-center justify-center h-full space-y-6">
                            <div class="w-20 h-20 bg-fe-accent rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-file-pdf text-4xl text-fe-primary"></i>
                            </div>
                            <div class="text-center">
                                <h4 class="text-xl font-semibold text-fe-primary-dark mb-2">PDF Viewer Not Supported</h4>
                                <p class="text-fe-spacegrey mb-6">Your browser doesn't support inline PDF viewing.</p>
                                <a href="{{ asset('storage/' . $executiveCommittee->document_path) }}" 
                                   target="_blank"
                                   class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-fe-primary text-white font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                                    <i class="fa-solid fa-download"></i> Download PDF Instead
                                </a>
                            </div>
                        </div>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
