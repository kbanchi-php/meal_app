<?php

namespace App\Http\Controllers;

use App\Models\MealCategory;
use App\Models\MealPost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MealPostRequest;

class MealPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get meal posts
        $posts = MealPost::latest()->paginate(4);

        // transfer view
        return view('meal_posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get all categories
        $categories = MealCategory::all();

        // transfer view
        return view('meal_posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MealPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MealPostRequest $request)
    {
        // get request form date
        $post = new MealPost();
        $post->fill($request->all());

        // set category
        $post->meal_category_id = $request->category;

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
            if (!Storage::putFIleAs('images/meal_posts', $file, $file_name)) {
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
        return redirect()->route('meal-posts.show', $post)
            ->with('notice', 'Complete create new Meal Post.');
    }

    /**
     * Display the specified resource.
     *
     * @param  MealPost $post
     * @return \Illuminate\Http\Response
     */
    public function show(MealPost $mealPost)
    {
        // get meal post info with user info
        $post = MealPost::with(['user'])->find($mealPost->id);

        // transfer view
        return view('meal_posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  MealPost $post
     * @return \Illuminate\Http\Response
     */
    public function edit(MealPost $mealPost)
    {
        // set post info
        $post = $mealPost;

        // get all categories
        $categories = MealCategory::all();

        // transfer view
        return view('meal_posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\MealPostRequest  $request
     * @param  MealPost $post
     * @return \Illuminate\Http\Response
     */
    public function update(MealPostRequest $request, MealPost $mealPost)
    {
        // get request form date
        $post = $mealPost;
        $post->fill($request->all());

        // set category
        $post->meal_category_id = $request->category;

        // set user id
        $post->user_id = auth()->user()->id;

        // check if file change, then get file info and set file name
        $new_file = $request->file('image');
        if ($new_file) {
            $delete_file_name = 'images/meal_posts/' . $post->image;
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
                if (!Storage::putFileAs('images/meal_posts', $new_file, $new_file_name)) {
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
        return redirect()->route('meal-posts.show', $post)
            ->with('notice', 'Complete update Meal Post.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  MealPost $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(MealPost $mealPost)
    {
        // set meal post info
        $post = $mealPost;

        // delete db and delete file transaction
        DB::beginTransaction();
        try {

            // delete db
            $post->delete();

            // delete file
            if (!Storage::delete('images/meal_posts/' . $post->image)) {
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
        return redirect()->route('meal-posts.index')
            ->with('notice', 'Complete delete Meal Post.');
    }
}
