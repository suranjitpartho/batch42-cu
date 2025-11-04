<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $heroBanners = HeroBanner::where('is_active', true)->orderBy('order', 'asc')->get();

        $events = Event::where('is_published', true)->latest()->take(4)->get();
        return view('frontend.home', compact('heroBanners', 'events'));
    }
}
