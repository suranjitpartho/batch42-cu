<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlumniMembership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = AlumniMembership::with('user')->latest()->paginate(10);
        return view('admin.memberships.index', compact('memberships'));
    }

    public function show(AlumniMembership $membership)
    {
        return view('admin.memberships.show', compact('membership'));
    }

    public function approve(AlumniMembership $membership)
    {
        $membership->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return redirect()->route('admin.memberships.index')->with('success', 'Membership application approved successfully.');
    }

    public function reject(Request $request, AlumniMembership $membership)
    {
        $request->validateWithBag('rejectMembership', [
            'rejection_reason' => 'required|string',
        ]);

        $membership->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()->route('admin.memberships.index')->with('success', 'Membership application rejected successfully.');
    }
}
