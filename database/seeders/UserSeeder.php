<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  
public function run()
{
    User::create([
        'first_name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => Hash::make('12345678'),
        'role_id' => 1,
        'phone'=>8976453212,
        'state_id' => 1,
    ]);
}
  
}

