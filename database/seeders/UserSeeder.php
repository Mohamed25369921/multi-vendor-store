<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'Mohamed Shaban',
            'email' => 'shaban@gmail.com',
            'password' => Hash::make('12345678'),
            'phone_number' => '01065124206',
        ]);

        DB::table('users')->insert([
            'name' => 'System Admin',
            'email' => 'sys@gmail.com',
            'password' => Hash::make('12345678'),
            'phone_number' => '010651242016',
        ]);
    }
}
