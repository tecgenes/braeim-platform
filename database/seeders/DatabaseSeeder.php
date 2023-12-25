<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Services\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role1 = Role::create([
            "name" => "Super Admin",
            "guard_name" => "web",
        ]);
        $role2 = Role::create([
            "name" => "Admin",
            "guard_name" => "web",
        ]);

        $developUser = User::create([
            "name" => "Marwan Sallum",
            'email' => "masalloum2091@gmail.com",
            "mobile" => "0500000000",
            "email_verified_at" => now(),
            "password" => Hash::make('password')
        ]);

        $developUser->assignRole($role1);
    }
}
