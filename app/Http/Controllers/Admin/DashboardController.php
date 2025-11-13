<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlumniMembership;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::whereNotNull('email_verified_at')->count();
        $roleCount = Role::count();
        $permissionCount = Permission::count();
        $approvedAlumniCount = AlumniMembership::where('status', 'approved')->count();

        return view('admin.dashboard', compact('userCount', 'roleCount', 'permissionCount', 'approvedAlumniCount'));
    }
}
