<?php

namespace Database\Factories;

use App\Models\Follower;
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
        // Get existing user IDs
        $userIds = User::pluck('id')->toArray();

        $followerId = $this->faker->randomElement($userIds);
        $followingId = $this->faker->randomElement($userIds);

        // Ensure unique combination of follower_id and following_id
        while (Follower::where('follower_id', $followerId)->where('following_id', $followingId)->exists()) {
            $followerId = $this->faker->randomElement($userIds);
            $followingId = $this->faker->randomElement($userIds);
        }

        return [
            'follower_id' => $followerId,
            'following_id' => $followingId,
        ];
    }
}
