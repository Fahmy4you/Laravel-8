<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
  
  public function category(Category $category) {
    return view('posts', [
      'title' => "Post By Category : $category->name",
      'posts' => $category->posts->load('author', 'category'),
      "active" => "category",
    ]);
  }
  
  public function categories()
  {
    return view('categories', [
      "title" => "Post Category",
      "categories" => Category::all(),
      "active" => "category",
    ]);
  }
  
}
