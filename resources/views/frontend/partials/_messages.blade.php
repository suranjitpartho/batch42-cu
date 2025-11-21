<section class="py-16 bg-fe-background relative overflow-hidden">
    {{-- Decorative background elements --}}
    <div class="absolute top-0 left-0 w-64 h-64 bg-fe-primary/5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-fe-secondary/5 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
             
             {{-- President Message --}}
             @if(isset($presidentMessage) && $presidentMessage)
                @php 
                    $pData = json_decode($presidentMessage->getTranslation('content', 'en'), true);
                @endphp
                <div class="group relative bg-white rounded-2xl shadow-sm overflow-hidden border border-fe-light-border">
                    
                    {{-- Top Accent Line --}}
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-fe-primary to-fe-primary-light"></div>
                    
                    <div class="p-6 md:p-8">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-fe-primary/10 flex items-center justify-center text-fe-primary group-hover:bg-fe-primary group-hover:text-white transition-colors duration-300 shrink-0">
                                    <i class="fas fa-pen-nib text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-fe-primary-dark font-bengali leading-tight">{{ $presidentMessage->getTranslation('title', 'bn') }}</h3>
                                    <p class="text-fe-secondary text-sm font-medium font-bengali mt-0.5">{{ $pData['name_bn'] ?? '' }}</p>
                                </div>
                            </div>
                            <div class="hidden md:block opacity-10 group-hover:opacity-20 transition-opacity duration-300">
                                <i class="fas fa-quote-right text-4xl text-fe-primary"></i>
                            </div>
                        </div>

                        <div class="prose max-w-none mb-4">
                            <p class="text-fe-spaceblack text-sm leading-relaxed font-bengali text-justify line-clamp-3 relative">
                                <span class="text-fe-primary text-xl font-serif mr-1">"</span>
                                {{ $pData['message_bn'] ?? '' }}
                                <span class="text-fe-primary text-xl font-serif ml-1">"</span>
                            </p>
                        </div>

                        <div class="flex justify-end">
                             <a href="{{ route('content_pages.show', 'president-message') }}" class="inline-flex items-center px-4 py-1.5 rounded-full bg-fe-background text-fe-primary-dark text-sm font-semibold font-bengali hover:bg-fe-primary hover:text-white transition-all duration-300 group-hover:shadow-md">
                                <span>সম্পূর্ণ পড়ুন</span>
                                <i class="fas fa-arrow-right ml-1.5 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                            </a>
                        </div>
                    </div>
                </div>
             @endif

             {{-- Secretary Message --}}
             @if(isset($secretaryMessage) && $secretaryMessage)
                @php 
                    $sData = json_decode($secretaryMessage->getTranslation('content', 'en'), true);
                @endphp
                <div class="group relative bg-white rounded-2xl shadow-sm overflow-hidden border border-fe-light-border">
                    
                    {{-- Top Accent Line --}}
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-fe-secondary to-fe-secondary-light"></div>
                    
                    <div class="p-6 md:p-8">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-fe-secondary/10 flex items-center justify-center text-fe-secondary group-hover:bg-fe-secondary group-hover:text-white transition-colors duration-300 shrink-0">
                                    <i class="fas fa-pen-nib text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-fe-primary-dark font-bengali leading-tight">{{ $secretaryMessage->getTranslation('title', 'bn') }}</h3>
                                    <p class="text-fe-secondary text-sm font-medium font-bengali mt-0.5">{{ $sData['name_bn'] ?? '' }}</p>
                                </div>
                            </div>
                            <div class="hidden md:block opacity-10 group-hover:opacity-20 transition-opacity duration-300">
                                <i class="fas fa-quote-right text-4xl text-fe-secondary"></i>
                            </div>
                        </div>

                        <div class="prose max-w-none mb-4">
                            <p class="text-fe-spaceblack text-sm leading-relaxed font-bengali text-justify line-clamp-3 relative">
                                <span class="text-fe-secondary text-xl font-serif mr-1">"</span>
                                {{ $sData['message_bn'] ?? '' }}
                                <span class="text-fe-secondary text-xl font-serif ml-1">"</span>
                            </p>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('content_pages.show', 'secretary-message') }}" class="inline-flex items-center px-4 py-1.5 rounded-full bg-fe-background text-fe-primary-dark text-sm font-semibold font-bengali hover:bg-fe-secondary hover:text-white transition-all duration-300 group-hover:shadow-md">
                                <span>সম্পূর্ণ পড়ুন</span>
                                <i class="fas fa-arrow-right ml-1.5 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                            </a>
                        </div>
                    </div>
                </div>
             @endif
        </div>
    </div>
</section>
