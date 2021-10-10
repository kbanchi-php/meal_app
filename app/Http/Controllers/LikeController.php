<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        // set favorite info
        $like = new Like();
        $like->user_id = auth()->user()->id;
        $like->post_id = $post->id;

        // db insert transaction
        DB::beginTransaction();
        try {
            // insert db
            $post->meal_favorites()->save($like);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like, Post $post)
    {
        // set favorite info
        $like = new Like();
        $like->user_id = auth()->user()->id;
        $like->post_id = $post->id;

        // db insert transaction
        DB::beginTransaction();
        try {
            // insert db
            $post->meal_favorites()->save($like);
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
