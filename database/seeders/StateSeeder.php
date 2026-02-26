<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  
public function run()
{
    State::create(['name' => 'Delhi']);
    State::create(['name' => 'Haryana']);
    State::create(['name' => 'Rajasthan']);
    State::create(['name' => 'Uttar Pradesh']);
    State::create(['name' => 'Gujarat']);
}
}
