<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  public function author(User $author) {
    return view('posts', [
      'title' => "Post By Author : $author->name",
      'active' => "author",
      'posts' => $author->posts->load('category', 'author'),
    ]);
  }
}
