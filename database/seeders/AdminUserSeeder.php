<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Make sure to replace 'admin@example.com' and 'password' with your desired admin email and password
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);

        
    }
}

