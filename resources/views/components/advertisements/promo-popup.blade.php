@if ($ads->isNotEmpty())
    <div
        x-data='{
            "ads": @json($ads->map(fn($ad) => ["title" => $ad->title, "image_path" => $ad->image_path, "link_url" => $ad->link_url])),
            "currentIndex": 0,
            "show": false,
            "dismissed": false,
            "displayTime": 6500,
            "timeBetweenCycles": 120000,
    
            calculateTimeBetweenAds() {
                const adCount = this.ads.length;
                if (adCount <= 1) {
                    return this.timeBetweenCycles;
                }
                const maxInterval = 40000;
                const minInterval = 10000;
                const maxAds = 10;
                const interval = maxInterval - ((maxInterval - minInterval) / (maxAds - 1)) * (adCount - 1);
                return Math.max(minInterval, interval);
            },
    
            init() {
                if (window.promoPopupTimer) {
                    clearTimeout(window.promoPopupTimer);
                }

                const storedIndex = sessionStorage.getItem("promoPopupCurrentIndex");
                if (storedIndex) {
                    this.currentIndex = parseInt(storedIndex, 10);
                }

                const cycleStarted = sessionStorage.getItem("promoPopupCycleStarted");
                if (cycleStarted === "true") {
                    // On navigation, show the *next* ad in the sequence quickly.
                    this.currentIndex = (this.currentIndex + 1) % this.ads.length;
                    window.promoPopupTimer = setTimeout(() => this.showNextAd(), 5000);
                } else {
                    // On first view of the session, set the flag and start after the initial delay.
                    sessionStorage.setItem("promoPopupCycleStarted", "true");
                    window.promoPopupTimer = setTimeout(() => this.showNextAd(), 10000);
                }
            },
    
            showNextAd() {
                if (this.dismissed || this.ads.length === 0) return;
    
                this.show = true;
                sessionStorage.setItem("promoPopupCurrentIndex", this.currentIndex.toString());
    
                window.promoPopupTimer = setTimeout(() => {
                    this.show = false;
                    
                    const isLastAd = this.currentIndex === this.ads.length - 1;
                    const nextInterval = isLastAd ? this.timeBetweenCycles : this.calculateTimeBetweenAds();
    
                    window.promoPopupTimer = setTimeout(() => {
                        this.currentIndex = (this.currentIndex + 1) % this.ads.length;
                        this.showNextAd();
                    }, nextInterval);
    
                }, this.displayTime);
            },
    
            dismiss() {
                this.dismissed = true;
                this.show = false;
                if (window.promoPopupTimer) {
                    clearTimeout(window.promoPopupTimer);
                }
            },
    
            get currentAd() {
                return this.ads[this.currentIndex];
            }
        }'
        x-init="init()"
        x-cloak
        class="fixed bottom-5 left-0 right-0 z-50 flex sm:left-5 sm:right-auto sm:justify-start">        <div x-show="show && !dismissed" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="transform translate-y-10 opacity-0"
            x-transition:enter-end="transform translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="transform translate-y-0 opacity-100"
            x-transition:leave-end="transform translate-y-10 opacity-0"
            class="w-11/12 mx-auto rounded-lg bg-white shadow-2xl ring-1 ring-black ring-opacity-5 sm:w-80 sm:mx-0">
            <div class="relative p-4">
                <!-- Close Button -->
                <button @click="dismiss()"
                    class="absolute top-2 right-2 flex h-5 w-5 items-center justify-center rounded-full text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 focus:outline-none">
                    <span class="sr-only">Close</span>
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Content -->
                <a :href="currentAd.link_url || '#'" :target="currentAd.link_url ? '_blank' : '_self'"
                    :rel="currentAd.link_url ? 'noopener noreferrer' : ''" class="flex items-center space-x-4"
                    :class="{ 'cursor-default': !currentAd.link_url }">
                    <!-- Image -->
                    <div class="flex-shrink-0">
                        <img class="h-14 w-14 rounded-md object-cover" :src="'/storage/' + currentAd.image_path"
                            :alt="currentAd.title">
                    </div>

                    <!-- Text -->
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-800 line-clamp-2" x-text="currentAd.title"></p>
                        <p class="text-xs text-gray-500">Sponsored</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endif