<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Justin', 
            'phone_number'=>'0123456789',
            'password' => Hash::make('1234'),
            'email' => 'justin.goh@wessconnect.com',
            'branch' => 0,
        ]);
    }
}