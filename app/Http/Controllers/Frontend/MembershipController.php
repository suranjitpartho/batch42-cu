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

    public function create(Request $request)
    {
        $user = auth()->user();
        
        if ($user->alumniMembership) {
            // If rejected, only allow access if 'reapply' param is present
            if ($user->alumniMembership->status === 'rejected') {
                if (!$request->has('reapply')) {
                    return redirect()->route('membership.show');
                }
                // If reapply is present, show the form (fall through)
            } else {
                // If pending or approved, always redirect to status
                return redirect()->route('membership.show');
            }
        }
        
        return view('frontend.pages.memberships.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->alumniMembership && $user->alumniMembership->status !== 'rejected')
        {
            return redirect()->route('membership.show');
        }

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'department' => 'required|string|max:255',
        ];

        if (!$user->profile_photo_path) {
            $rules['photo'] = 'required|image|max:1024';
        }

        $request->validate($rules);

        // Update user profile if needed
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->department = $request->department;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->save();

        if ($user->alumniMembership) {
            // Re-application: Update existing record
            $user->alumniMembership->update([
                'status' => 'pending',
                'rejection_reason' => null,
                'applied_at' => now(),
                // Reset other fields if needed, though they are defaults now
            ]);
        } else {
            // New application
            AlumniMembership::create([
                'user_id' => $user->id,
                'membership_type' => 'General', // Default value
                'transaction_id' => 'N/A',      // Default value
                'payment_method' => 'N/A',      // Default value
                'applied_at' => now(),
                'status' => 'pending',
            ]);
        }

        return redirect()->route('membership.show')->with('success', 'Your membership application has been submitted successfully.');
    }

    public function show()
    {
        $membership = auth()->user()->alumniMembership;
        return view('frontend.pages.memberships.show', compact('membership'));
    }
}
