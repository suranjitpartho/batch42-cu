<section class="py-16 bg-fe-background relative overflow-hidden" x-data="{ shown: false }" x-intersect.threshold.20="shown = true">
    {{-- Decorative background elements --}}
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-5%] w-[40rem] h-[40rem] bg-fe-primary/5 rounded-full blur-3xl mix-blend-multiply"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[40rem] h-[40rem] bg-fe-secondary/5 rounded-full blur-3xl mix-blend-multiply"></div>
        <div class="absolute top-[20%] right-[10%] w-72 h-72 bg-purple-100/30 rounded-full blur-2xl mix-blend-multiply"></div>
        <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-20 lg:gap-y-12 pt-10">
             
             {{-- President Message --}}
             @if(isset($presidentMessage) && $presidentMessage)
                @php 
                    $pData = json_decode($presidentMessage->getTranslation('content', 'en'), true);
                @endphp
                <div class="relative group transition-all duration-1000 ease-out transform"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'">
                    {{-- Floating Avatar --}}
                    <div class="absolute -top-12 left-8 z-20 transition-transform duration-500 group-hover:-translate-y-2">
                        <div class="relative">
                            @if($presidentMessage->image_path)
                                <div class="w-24 h-24 rounded-2xl rotate-3 overflow-hidden border-4 border-white shadow-lg bg-white">
                                    <img src="{{ asset('storage/' . $presidentMessage->image_path) }}" alt="{{ $pData['name_bn'] ?? 'President' }}" class="w-full h-full object-cover -rotate-3 scale-110">
                                </div>
                            @else
                                <div class="w-24 h-24 rounded-2xl rotate-3 flex items-center justify-center bg-gradient-to-br from-fe-primary to-fe-primary-dark text-white shadow-lg border-4 border-white">
                                    <i class="fas fa-user-tie text-3xl -rotate-3"></i>
                                </div>
                            @endif
                            <div class="absolute -bottom-3 -right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md text-fe-primary border-2 border-fe-background">
                                <i class="fas fa-quote-right text-sm"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Message Bubble --}}
                    <div class="relative bg-white rounded-[2.5rem] rounded-tl-none p-8 pt-16 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-white/50 backdrop-blur-sm transition-all duration-500 group-hover:shadow-[0_20px_50px_-10px_rgba(0,0,0,0.12)]">
                        {{-- Decorative Tail --}}
                        <div class="absolute -top-[1px] -left-[1px] w-8 h-8 bg-fe-background border-b border-r border-transparent rounded-br-3xl z-10"></div>
                        <svg class="absolute top-0 left-0 w-8 h-8 text-white fill-current -z-10" viewBox="0 0 32 32">
                            <path d="M0,32 L32,32 L32,0 C32,16 16,32 0,32 Z"></path>
                        </svg>

                        <div class="relative z-10">
                            <div class="mb-4 pl-2">
                                <h3 class="text-2xl font-bold text-fe-primary-dark font-bengali leading-tight mb-1">{{ $presidentMessage->getTranslation('title', 'bn') }}</h3>
                                <div class="flex items-center gap-3">
                                    <div class="h-px w-8 bg-fe-primary/30"></div>
                                    <p class="text-fe-secondary text-sm font-medium font-bengali">{{ $pData['name_bn'] ?? '' }}</p>
                                </div>
                            </div>

                            <div class="relative bg-fe-background/50 rounded-2xl p-6 mb-6 group-hover:bg-fe-primary/5 transition-colors duration-500">
                                <i class="fas fa-quote-left absolute top-4 left-4 text-2xl text-fe-primary/10"></i>
                                <p class="text-fe-spaceblack text-base leading-relaxed font-bengali text-left line-clamp-3 relative z-10 px-2">
                                    {{ $pData['message_bn'] ?? '' }}
                                </p>
                            </div>

                            <div class="flex justify-end">
                                <a href="{{ route('content_pages.show', 'president-message') }}" class="group/btn relative inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-fe-primary text-white text-sm font-semibold font-bengali overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-fe-primary/30 hover:-translate-y-0.5">
                                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                                    <span class="relative">সম্পূর্ণ পড়ুন</span>
                                    <i class="fas fa-arrow-right relative text-xs transition-transform duration-300 group-hover/btn:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
             @endif

             {{-- Secretary Message --}}
             @if(isset($secretaryMessage) && $secretaryMessage)
                @php 
                    $sData = json_decode($secretaryMessage->getTranslation('content', 'en'), true);
                @endphp
                <div class="relative group transition-all duration-1000 delay-200 ease-out transform"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'">
                    {{-- Floating Avatar --}}
                    <div class="absolute -top-12 right-8 z-20 transition-transform duration-500 group-hover:-translate-y-2">
                        <div class="relative">
                            @if($secretaryMessage->image_path)
                                <div class="w-24 h-24 rounded-2xl -rotate-3 overflow-hidden border-4 border-white shadow-lg bg-white">
                                    <img src="{{ asset('storage/' . $secretaryMessage->image_path) }}" alt="{{ $sData['name_bn'] ?? 'Secretary' }}" class="w-full h-full object-cover rotate-3 scale-110">
                                </div>
                            @else
                                <div class="w-24 h-24 rounded-2xl -rotate-3 flex items-center justify-center bg-gradient-to-bl from-fe-secondary to-fe-secondary-light text-white shadow-lg border-4 border-white">
                                    <i class="fas fa-user-pen text-3xl rotate-3"></i>
                                </div>
                            @endif
                            <div class="absolute -bottom-3 -left-3 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md text-fe-secondary border-2 border-fe-background">
                                <i class="fas fa-quote-right text-sm"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Message Bubble --}}
                    <div class="relative bg-white rounded-[2.5rem] rounded-tr-none p-8 pt-16 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-white/50 backdrop-blur-sm transition-all duration-500 group-hover:shadow-[0_20px_50px_-10px_rgba(0,0,0,0.12)]">
                        
                        <div class="relative z-10">
                            <div class="mb-4 pr-2 text-right">
                                <h3 class="text-2xl font-bold text-fe-primary-dark font-bengali leading-tight mb-1">{{ $secretaryMessage->getTranslation('title', 'bn') }}</h3>
                                <div class="flex items-center justify-end gap-3">
                                    <p class="text-fe-secondary text-sm font-medium font-bengali">{{ $sData['name_bn'] ?? '' }}</p>
                                    <div class="h-px w-8 bg-fe-secondary/30"></div>
                                </div>
                            </div>

                            <div class="relative bg-fe-background/50 rounded-2xl p-6 mb-6 group-hover:bg-fe-secondary/5 transition-colors duration-500">
                                <i class="fas fa-quote-left absolute top-4 left-4 text-2xl text-fe-secondary/10"></i>
                                <p class="text-fe-spaceblack text-base leading-relaxed font-bengali text-left line-clamp-3 relative z-10 px-2">
                                    {{ $sData['message_bn'] ?? '' }}
                                </p>
                            </div>

                            <div class="flex justify-start">
                                <a href="{{ route('content_pages.show', 'secretary-message') }}" class="group/btn relative inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-fe-secondary text-white text-sm font-semibold font-bengali overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-fe-secondary/30 hover:-translate-y-0.5">
                                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                                    <span class="relative">সম্পূর্ণ পড়ুন</span>
                                    <i class="fas fa-arrow-right relative text-xs transition-transform duration-300 group-hover/btn:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
             @endif
        </div>
    </div>
</section>
