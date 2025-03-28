<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        DB::table('users')->insert([
            'name' => 'Teach',
            'email' => 'teacher@example.com',
            'password' => Hash::make('teacher123'),
            'role' => 'teacher',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
