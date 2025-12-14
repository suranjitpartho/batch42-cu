<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use App\Models\Event;
use App\Models\Notice;
use App\Models\UniversityInfo; // Add this line
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $heroBanners = HeroBanner::where('is_active', true)->orderBy('order', 'asc')->get();

        $eventsQuery = Event::where('is_published', true);
        $showAllEventsButton = (clone $eventsQuery)->count() > 4;
        $events = (clone $eventsQuery)->latest()->take(4)->get();

        $baseQuery = Notice::query()
            ->when(!Auth::check() || !Auth::user()->alumniMembership || Auth::user()->alumniMembership->status !== 'approved', function ($query) {
                return $query->where('members_only', false);
            });

        $noticesCount = (clone $baseQuery)->count();
        $notices = (clone $baseQuery)->latest()->take(2)->get();

        $showAllNoticesButton = $noticesCount > 2;

        $info = UniversityInfo::first();

        $presidentMessage = \App\Models\ContentPage::where('slug', 'president-message')->first();
        $secretaryMessage = \App\Models\ContentPage::where('slug', 'secretary-message')->first();

        $videos = \App\Models\VideoGallery::where('is_active', true)->orderBy('order')->orderBy('created_at', 'desc')->take(3)->get();
        $executiveCommittee = \App\Models\ExecutiveCommittee::where('is_active', true)->orderBy('year', 'desc')->first();

        return view('frontend.home', compact('heroBanners', 'events', 'showAllEventsButton', 'notices', 'showAllNoticesButton', 'info', 'presidentMessage', 'secretaryMessage', 'videos', 'executiveCommittee'));
    }
}
