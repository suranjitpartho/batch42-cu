<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class UserAssignRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:assign-role {email} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a role to a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (!$user) {
            $this->error('User not found.');
            return 1;
        }

        $role = Role::where('name', $this->argument('role'))->first();

        if (!$role) {
            $this->error('Role not found.');
            return 1;
        }

        $user->assignRole($role);
        $this->info("Role '{$role->name}' assigned to user '{$user->email}' successfully.");

        return 0;
    }
}