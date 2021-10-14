<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class LikeController extends Controller
{

    /**
     * Like Meal Post.
     *
     * @param  Illuminate\Http\Request;  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
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

        // prevent double registration
        $request->session()->regenerateToken();

        // redirect view
        return redirect()
            ->route('posts.show', $post)
            ->with('notice', 'Like to Meal Post.');
    }

    /**
     * UnLike Meal Post.
     *
     * @param  Illuminate\Http\Request;  $request
     * @param  Post  $post
     * @param  Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post, Like $like)
    {
        // db insert transaction
        DB::beginTransaction();
        try {
            // delete db
            $like->delete();
            // commit
            DB::commit();
        } catch (\Exception $e) {
            // rollback
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        // prevent double registration
        $request->session()->regenerateToken();

        // redirect view
        return redirect()
            ->route('posts.show', $post)
            ->with('notice', 'Unlike from Meal Post.');
    }
}
