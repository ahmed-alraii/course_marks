<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
           'password' => Hash::make('Aa123456'),
           'role_id' => 1
        ]);
        User::create([
            'name' => 'Teacher 1',
            'email' => 'teacher1@gmail.com',
            'password' => Hash::make('Aa123456'),
            'role_id' => 2
        ]);
        User::create([
            'name' => 'Teacher 2',
            'email' => 'teacher2@gmail.com',
            'password' => Hash::make('Aa123456'),
            'role_id' => 2
        ]);
    }
}
