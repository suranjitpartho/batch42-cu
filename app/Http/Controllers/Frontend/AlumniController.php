<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        // Start with a query builder for users
        $query = User::query();

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
        $users = $query->paginate(9)->withQueryString();

        // Get distinct values for filter dropdowns
        $departments = User::select('department')->whereNotNull('department')->distinct()->orderBy('department')->pluck('department');
        $cities = User::select('current_city')->whereNotNull('current_city')->distinct()->orderBy('current_city')->pluck('current_city');
        $blood_groups = User::select('blood_group')->whereNotNull('blood_group')->distinct()->orderBy('blood_group')->pluck('blood_group');

        return view('frontend.pages.alumni.index', [
            'users' => $users,
            'departments' => $departments,
            'cities' => $cities,
            'blood_groups' => $blood_groups,
        ]);
    }
}
