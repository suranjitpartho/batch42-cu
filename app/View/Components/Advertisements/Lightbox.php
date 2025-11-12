<?php

namespace App\View\Components\Advertisements;

use App\Models\Advertisement;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Lightbox extends Component
{
    public ?Advertisement $ad;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->ad = Advertisement::where('type', 'lightbox')->where('is_active', true)->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.advertisements.lightbox');
    }
}
