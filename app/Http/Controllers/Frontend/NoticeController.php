<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::query()
            ->when(!Auth::check() || !Auth::user()->alumniMembership || Auth::user()->alumniMembership->status !== 'approved', function ($query) {
                return $query->where('members_only', false);
            })
            ->latest()
            ->paginate(3);

        return view('frontend.pages.notices.index', compact('notices'));
    }

    public function show(Notice $notice)
    {
        if ($notice->members_only) {
            if (!Auth::check() || !Auth::user()->alumniMembership || Auth::user()->alumniMembership->status !== 'approved') {
                abort(403);
            }
        }

        return view('frontend.pages.notices.show', compact('notice'));
    }
}
