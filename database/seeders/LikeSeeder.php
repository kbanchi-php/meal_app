<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\User::all() as $user) {
            foreach (\App\Models\Post::all() as $post) {
                $param = [
                    [
                        'user_id' => $user->id,
                        'post_id' => $post->id
                    ],
                ];
                DB::table('likes')->insert($param);
            }
        }
    }
}
