<?php

namespace App\View\Components\Advertisements;

use App\Models\Advertisement;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class Footer extends Component
{
    public Collection $ads;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->ads = Advertisement::where('type', 'footer')
            ->where('is_active', true)
            ->orderBy('order')
            ->take(5)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.advertisements.footer');
    }
}
