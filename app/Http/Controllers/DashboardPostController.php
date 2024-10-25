<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('dashboard.posts.index', [
        'title' => 'My Posts',
        'active' => 'dbposts',
        'postsUser' => Post::where('user_id', auth()->user()->id)->get(),
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.posts.create', [
        'title' => 'Form Create Post',
        'active' => 'dbposts',
        'categories' => Category::all(),
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      return $request->file('image')->store('post-images');
      
      $validatedData = $request->validate([
        'title' => 'required|max:100',
        'slug' => 'required|unique:posts',
        'category_id' => 'required',
        'body' => 'required',
      ]);
      
      $validatedData['user_id'] = auth()->user()->id;
      
      $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 150);
      
      Post::create($validatedData);
      
      return redirect('/dashboard/posts')->with('success', 'New Post Has Been Added');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      return view('dashboard.posts.show', [
        'title' => 'Detail Post',
        'active' => 'dbposts',
        'postUser' => $post,
      ]);
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
      return view('dashboard.posts.edit', [
        'title' => 'Form Edit Post',
        'active' => 'dbposts',
        'categories' => Category::all(),
        'post' => $post,
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      $rules = [
        'title' => 'required|max:100',
        'category_id' => 'required',
        'body' => 'required',
      ];
      
      if($request->slug != $post->slug) {
        $rules['slug'] = 'required|unique:posts';
      }
      
      $validatedData = $request->validate($rules);
      
      $validatedData['user_id'] = auth()->user()->id;
      
      $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 150);
      
      Post::where('id', $post->id)
            ->update($validatedData);
      
      return redirect('/dashboard/posts')->with('success', 'Post Has Been Updated');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      Post::destroy($post->id);
      
      return redirect('/dashboard/posts')->with('success', 'Post Has Been Deleted');
    }
    
    public function checkSlug(Request $request) 
    {
      $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
      
      return response()->json(['slug' => $slug]);
    }
    
}
