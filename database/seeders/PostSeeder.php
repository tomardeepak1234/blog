<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Role;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    

public function run(): void
{
    // Role::factory()->create(['name' => 'Admin']);
    // Role::factory()->create(['name' => 'User']);
    // Role::factory()->create(['name' => 'Author']);
    // User::factory(10)->create();
  

    Post::factory(5)->create();
}

}
