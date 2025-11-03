<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;

class HomeController extends Controller
{
    public function index()
    {
        $heroBanners = HeroBanner::where('is_active', true)->orderBy('order', 'asc')->get();

        return view('frontend.home', compact('heroBanners'));
    }
}
