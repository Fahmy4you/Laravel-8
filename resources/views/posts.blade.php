@extends('layouts.main')

@section('container')
  
  <h1 class="mb-3 text-center">{{ $title }}</h1>
  
  <div class="row justify-content-center mb-3">
    <div class="col-md-8">
      <form action="/posts" method="get">
        @if( request('category') && request('author') )
          <input name="category" value="{{ request('category') }}" type="hidden">
          <input name="author" value="{{ request('author') }}" type="hidden">
          
        @elseif( request('author') )
          <input name="author" value="{{ request('author') }}" type="hidden">
        
        @elseif( request('category') )
          <input name="category" value="{{ request('category') }}" type="hidden">
        
        @endif
        <div class="input-group mb-3">
          
          <input type="text" class="form-control" placeholder="Search..." name="input-search" value="{{ request('input-search') }}" autocomplete="off">
          
          <button class="btn btn-danger" type="submit">Search</button>
          
        </div>
        
      </form>
    </div>
  </div>
  
  @if($posts->count())
    <div class="card mb-3">
      <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
      <div class="card-body text-center">
        <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h3>
        
        <p>
          <small class="text-muted">
            By. <a class="text-decoration-none" href="/posts?author={{ $posts[0]->author->username }}">{{ $posts[0]->author->name }}</a> in <a class="text-decoration-none" href="/posts?category={{ $posts[0]->category->slug }}">{{ $posts[0]->category->name }}</a> {{ $posts[0]->created_at->diffForHumans() }}
          </small>
        </p>
        
        <p class="card-text">{{ $posts[0]->excerpt }}</p>
        
        <a class="btn btn-primary" href="/posts/{{ $posts[0]->slug }}">Read More...</a>
        
      </div>
    </div>    
  
  <div class="container">
    <div class="row">
      @foreach( $posts->skip(1) as $post )
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="position-absolute px-3 py-2" style="background: rgba(0,0,0,0.7)">
              <a class="text-decoration-none text-white" href="/posts?category={{ $post->category->slug }}">{{ $post->category->name }}</a>
            </div>
            
            <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
            
            <div class="card-body">
              <h5 class="card-title">{{ $post->title }}</h5>
              
              <p>
                <small class="text-muted">
                  By. <a class="text-decoration-none" href="/posts?author={{ $post->author->username }}">{{ $post->author->name }}</a> {{ $post->created_at->diffForHumans() }}
                </small>
              </p>
              
              <p class="card-text">{{ $post->excerpt }}</p>
              
              <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read More...</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  
  @else
    <p class="text-center fs-4">No Post Found.</p>
  
  @endif
  
  <div class="d-flex justify-content-center">
    {{ $posts->links() }}
  </div>
  
@endsection