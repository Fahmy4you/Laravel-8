<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class PostController extends Controller
{
  public function posts()
  {
    $title = "";
    
    if(request('category')) {
      $category = Category::firstWhere('slug', request('category'));
      $title = " in " . $category->name;
      
    } elseif(request('author')) {
      $author = User::firstWhere('username', request('author'));
      $title = " By " . $author->name;
    }
    
    return view('posts', [
      "title" => "All Posts". $title,
      // "posts" => Post::all(),
      
      // Semua Data
      /*
      "posts" => Post::latest()->filter(request(['input-search', 'category', 'author']))->get(),
      */
      
      // Pagination Data 
      "posts" => Post::latest()->filter(request(['input-search', 'category', 'author']))->paginate(7)->withQueryString(),
      
      "active" => "posts",
    ]);
    
  }
  
  public function showPost(Post $post) 
  {
    return view('post', [
      "title" => "Single Post",
      "post"  => $post,
      "active" => "posts",
    ]);
    
  }
  
}