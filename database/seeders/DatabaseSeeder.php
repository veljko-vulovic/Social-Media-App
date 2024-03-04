<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Follower;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Admin Admin',
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);


        User::factory(30)->create();

        Follower::factory(5)->create();

        Group::factory(3)->hasUsers(3)->create();


        Post::factory(15)->create();
        Post::factory(3)->create([
            'user_id' => $admin,
            'content' => fake()->paragraph(3),
        ]);
    }
}
