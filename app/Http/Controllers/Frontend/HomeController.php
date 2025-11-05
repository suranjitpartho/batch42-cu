<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use App\Models\Event;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $heroBanners = HeroBanner::where('is_active', true)->orderBy('order', 'asc')->get();

        $events = Event::where('is_published', true)->latest()->take(4)->get();

        $baseQuery = Notice::query()
            ->when(!Auth::check() || !Auth::user()->alumniMembership || Auth::user()->alumniMembership->status !== 'approved', function ($query) {
                return $query->where('members_only', false);
            });

        $noticesCount = (clone $baseQuery)->count();
        $notices = (clone $baseQuery)->latest()->take(2)->get();

        $showAllNoticesButton = $noticesCount > 2;

        return view('frontend.home', compact('heroBanners', 'events', 'notices', 'showAllNoticesButton'));
    }
}
