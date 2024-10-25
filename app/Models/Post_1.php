<?php 

namespace App\Models;

class Post
{
  private static $blog_posts = [
    [
      "title" => "Judul Post Pertama",
      "slug" => "judul-post-pertama",
      "author" => "Fbaz Gans",
      "body" => "Aku Suka Kamu Eh Kamu Suka Dia Sakit Gila Aowkwkwkkw, Hinjam Jom Aowkwkkwkw Bacod Bacod Anjg Gw Sakit Hati Ngentod Asw Bgsd",
    ],
    [
      "title" => "Judul Post KeDua",
      "slug" => "judul-post-kedua",
      "author" => "Fahmi Gans",
      "body" => "Aku Suka Kamu Eh Kamu Suka Dia Sakit Gila Aowkwkwkkw, Hinjam Jom Aowkwkkwkw Bacod Bacod Anjg Gw Sakit Hati Ngentod Asw Bgsd, Au Ah Tau Anjg",
    ],
    
  ];
  
  public static function all() 
  {
    // Tidak Static 
    // return $this->$blog_posts;
    
    // Static
    return collect(self::$blog_posts);
  }
  
  public static function find($slug) 
  {
    $posts = static::all();
    
    return $posts->firstWhere('slug', $slug);
  }
  
}
