<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create the user
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        //assign admin role to admin
        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Frontdesk',
            'email' => 'frontdesk@example.com',
            'password' => bcrypt('password'),
        ]);

        //assign frontdesk role to frontdesk
        $user->assignRole('frontdesk');
    }
}
