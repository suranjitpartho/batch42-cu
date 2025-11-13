<?php

namespace App\View\Components\Advertisements;

use App\Models\Advertisement;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class PromoPopup extends Component
{
    public Collection $ads;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->ads = Advertisement::where('type', 'promo_popup')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.advertisements.promo-popup');
    }
}
