<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Follower>
 */
class FollowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = User::find(1)->first()->id;
        $follower_id = User::inRandomOrder()->first()->id;

        return [
            'follower_id' => $user_id,
            'following_id' => $follower_id,
        ];
    }
}
