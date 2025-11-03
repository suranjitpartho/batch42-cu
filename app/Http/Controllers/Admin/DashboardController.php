<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $roleCount = Role::count();
        $permissionCount = Permission::count();

        return view('admin.dashboard', compact('userCount', 'roleCount', 'permissionCount'));
    }
}
