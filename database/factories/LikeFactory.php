<?php

namespace Database\Factories;

use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $users = [];
        foreach (\App\Models\User::all() as $user) {
            $users[] = $user->id;
        }

        $posts = [];
        foreach (\App\Models\Post::all() as $post) {
            $post[] = $post->id;
        }

        return [
            'user_id' => $users[array_rand($users)],
            'post_id' => $posts[array_rand($posts)],
        ];
    }
}
