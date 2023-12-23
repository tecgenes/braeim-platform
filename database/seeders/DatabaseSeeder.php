<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role = Role::create([
            "name" => "Super Admin",
            "guard_name" => "web",
        ]);

        $developUser = User::create([
            "name" => "Marwan Sallum",
            'email' => "masalloum2091@gmail.com",
            "mobile" => "0500000000",
            "email_verified_at" => "2023/11/01",
            "password" => Hash::make('password')
        ]);

        $developUser->assignRole($role);
    }
}
