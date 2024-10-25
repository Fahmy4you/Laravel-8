<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UmumController extends Controller
{
  public function home()
  {
    return view('home', [
      "title" => "Home",
      "active" => "home",
    ]);
  }
  
  public function about()
  {
    return view('about', [
      "name"  => "Fbaz",
      "email" => "fbazgans123@gmail.com",
      "image" => "fbaz.jpeg",
      "title" => "About",
      "active" => "about",
    ]);
  }
  
}
