<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class LikeController extends Controller
{

    public function like($id)
    {
        // get post info
        $post = Post::find($id);

        // set like info
        $like = new Like();
        $like->user_id = auth()->user()->id;
        $like->post_id = $post->id;

        // db insert transaction
        DB::beginTransaction();
        try {
            // insert db
            $post->likes()->save($like);
            // commit
            DB::commit();
        } catch (\Exception $e) {
            // rollback
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        // redirect view
        return redirect()
            ->route('posts.show', $post)
            ->with('notice', 'Like to Meal Post.');
    }

    public function unlike($id)
    {
        // get post info
        $post = Post::find($id);

        // set favorite info
        $query = Like::query();
        $query->where('user_id', auth()->user()->id);
        $query->where('post_id', $post->id);

        // db insert transaction
        DB::beginTransaction();
        try {
            // delete db
            $query->delete();
            // commit
            DB::commit();
        } catch (\Exception $e) {
            // rollback
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        // redirect view
        return redirect()
            ->route('posts.show', $post)
            ->with('notice', 'Unlike to Meal Post.');
    }
}
