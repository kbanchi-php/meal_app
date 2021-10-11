<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Category;
use App\Models\Like;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get meal posts
        $posts = Post::with(['user', 'likes'])->latest()->paginate(4);

        // transfer view
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get all categories
        $categories = Category::all();

        // transfer view
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // get request form date
        $post = new Post();
        $post->fill($request->all());

        // set category
        $post->category_id = $request->category;

        // set user id
        $post->user_id = auth()->user()->id;

        // get file info and set file name
        $file = $request->file('image');
        $file_name = date('YmdHis') . '_' . $file->getClientOriginalName();
        $post->image = $file_name;

        // insert db and save file transaction
        DB::beginTransaction();
        try {

            // insert db
            $post->save();

            // save file
            if (!Storage::putFIleAs('images/posts', $file, $file_name)) {
                throw new \Exception("Faild to save image...");
            }

            // commit
            DB::commit();
        } catch (\Exception $e) {
            // if cause exception, rollback db insert and save file
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        // redirect view
        return redirect()->route('posts.show', $post)
            ->with('notice', 'Complete create new Meal Post.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // get meal post info with user info
        $post = Post::with(['user', 'likes'])->find($post->id);

        // get like from user_id and post_id
        $query = Like::query();
        $query->where('user_id', auth()->user()->id);
        $query->where('post_id', $post->id);
        $like = $query->get();

        // transfer view
        return view('posts.show', compact('post', 'like'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // get all categories
        $categories = Category::all();

        // transfer view
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        // get request form date
        $post->fill($request->all());

        // set category
        $post->category_id = $request->category;

        // set user id
        $post->user_id = auth()->user()->id;

        // check if file change, then get file info and set file name
        $new_file = $request->file('image');
        if ($new_file) {
            $delete_file_name = 'images/posts/' . $post->image;
            $new_file_name = date('YmdHis') . '_' . $new_file->getClientOriginalName();
            $post->image = $new_file_name;
        }

        // insert db and save file transaction
        DB::beginTransaction();
        try {

            // insert db
            $post->save();

            // if file change, save new file and delete old file
            if ($new_file) {
                // save new file
                if (!Storage::putFileAs('images/posts', $new_file, $new_file_name)) {
                    throw new \Exception('Faild to save new image...');
                }
                // delete old file
                if (!Storage::delete($delete_file_name)) {
                    throw new \Exception('Faild to delete old image...');
                }
            }

            // commit
            DB::commit();
        } catch (\Exception $e) {
            // if cause exception, rollback db insert and save new file and delete old file
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        // redirect view
        return redirect()->route('posts.show', $post)
            ->with('notice', 'Complete update Meal Post.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // delete db and delete file transaction
        DB::beginTransaction();
        try {

            // delete db
            $post->delete();

            // delete file
            if (!Storage::delete('images/posts/' . $post->image)) {
                throw new \Exception('Faild to delete old image...');
            }
            // commit
            DB::commit();
        } catch (\Exception $e) {
            // if cause exception, rollback db insert and save new file and delete old file
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        // redirect view
        return redirect()->route('posts.index')
            ->with('notice', 'Complete delete Meal Post.');
    }
}
