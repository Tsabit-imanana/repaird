<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'), // Ganti 'password' dengan password yang diinginkan
            'role' => 'admin',
        ]);

        User::create([
            "name" => "cs",
            "username" => "cs",
            'email' => 'cs@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'cs'
        ]);
        User::create([
            "name" => "manager",
            "username" => "manager",
            'email' => 'manager@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'manager'
        ]);
        User::create([
            "name" => "repair",
            "username" => "repair",
            'email' => 'repair@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'repair'
        ]);


    }
}
