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
            $search = $request->name;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('first_name', 'like', '%' . $search . '%')
                  ->orWhere('last_name', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('faculty')) {
            $query->where('faculty', $request->faculty);
        }

        if ($request->filled('blood_group')) {
            $query->where('blood_group', $request->blood_group);
        }

        // Paginate the results
        $users = $query->orderBy('created_at', 'asc')->paginate(9)->withQueryString();

        // Get distinct values for filter dropdowns from approved alumni
        $fullConfig = config('university_data.faculties');
        $filteredConfig = [];

        // Get all used faculty-department pairs
        $usedFacultiesAndDepts = User::whereHas('alumniMembership', function ($q) {
            $q->where('status', 'approved');
        })
        ->select('faculty', 'department')
        ->whereNotNull('faculty')
        ->whereNotNull('department')
        ->distinct()
        ->get()
        ->groupBy('faculty');

        foreach ($fullConfig as $faculty => $departments) {
            if ($usedFacultiesAndDepts->has($faculty)) {
                // Get the departments used in this faculty from DB
                $usedDeptsInFaculty = $usedFacultiesAndDepts->get($faculty)->pluck('department')->toArray();
                
                // Intersect config departments with used departments to maintain config order
                $validDepts = array_values(array_intersect($departments, $usedDeptsInFaculty));
                
                if (!empty($validDepts)) {
                    $filteredConfig[$faculty] = $validDepts;
                }
            }
        }

        $blood_groups = User::whereHas('alumniMembership', function ($q) {
            $q->where('status', 'approved');
        })->select('blood_group')->whereNotNull('blood_group')->distinct()->orderBy('blood_group')->pluck('blood_group');

        return view('frontend.pages.alumni.index', [
            'users' => $users,
            'facultiesConfig' => $filteredConfig,
            'blood_groups' => $blood_groups,
        ]);
    }

    public function show(User $user)
    {
        return view('frontend.pages.alumni.show', compact('user'));
    }
}
