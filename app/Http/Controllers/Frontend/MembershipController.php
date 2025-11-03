<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AlumniMembership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->alumniMembership)
        {
            return redirect()->route('membership.show');
        }
        return view('frontend.pages.memberships.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'membership_type' => 'required|string|max:255',
            'transaction_id' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        if ($user->alumniMembership)
        {
            return redirect()->route('membership.show');
        }

        AlumniMembership::create([
            'user_id' => $user->id,
            'membership_type' => $request->membership_type,
            'transaction_id' => $request->transaction_id,
            'payment_method' => $request->payment_method,
            'applied_at' => now(),
        ]);

        return redirect()->route('membership.show')->with('success', 'Your membership application has been submitted successfully.');
    }

    public function show()
    {
        $membership = auth()->user()->alumniMembership;
        return view('frontend.pages.memberships.show', compact('membership'));
    }
}
