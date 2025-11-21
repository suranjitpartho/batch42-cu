<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumniController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            
            // Allow if user is admin OR has approved alumni membership
            if ($user && ($user->hasRole('admin') || ($user->alumniMembership && $user->alumniMembership->status === 'approved'))) {
                return $next($request);
            }

            return redirect()->route('home')->with('error', 'You must be an approved alumni member to view the directory.');
        });
    }

    public function index(Request $request)
    {
        // Start with a query builder for users who have an approved alumni membership
        $query = User::whereHas('alumniMembership', function ($q) {
            $q->where('status', 'approved');
        });

        // Apply filters based on request input
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('city')) {
            $query->where('current_city', $request->city);
        }

        if ($request->filled('blood_group')) {
            $query->where('blood_group', $request->blood_group);
        }

        // Paginate the results
        $users = $query->paginate(3)->withQueryString();

        // Get distinct values for filter dropdowns from approved alumni
        $departments = User::whereHas('alumniMembership', function ($q) {
            $q->where('status', 'approved');
        })->select('department')->whereNotNull('department')->distinct()->orderBy('department')->pluck('department');

        $cities = User::whereHas('alumniMembership', function ($q) {
            $q->where('status', 'approved');
        })->select('current_city')->whereNotNull('current_city')->distinct()->orderBy('current_city')->pluck('current_city');

        $blood_groups = User::whereHas('alumniMembership', function ($q) {
            $q->where('status', 'approved');
        })->select('blood_group')->whereNotNull('blood_group')->distinct()->orderBy('blood_group')->pluck('blood_group');

        return view('frontend.pages.alumni.index', [
            'users' => $users,
            'departments' => $departments,
            'cities' => $cities,
            'blood_groups' => $blood_groups,
        ]);
    }

    public function show(User $user)
    {
        return view('frontend.pages.alumni.show', compact('user'));
    }
}
