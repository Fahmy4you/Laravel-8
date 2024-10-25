@extends('dashboard.layouts.main')

@section('container')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  
    <h1 class="h2">Detail Post</h1>
  
  </div>
  
  <div class="container">
      <div class="row my-3">
        <div class="col-lg-8">
          <h1 class="mb-3">{{ $postUser->title }}</h1>
          
          <img src="https://source.unsplash.com/1200x400?{{ $postUser->category->name }}" class="img-fluid" alt="{{ $postUser->category->name }}">
          
          <article class="my-3 fs-5">
            {!! $postUser->body !!}
          </article>
          
          <a href="/dashboard/posts" class="btn btn-info mt-3"><span data-feather="arrow-left"></span> Back</a>
          <a href="/dashboard/posts/{{ $postUser->slug }}/edit" class="btn btn-primary mt-3"><span data-feather="edit"></span> Edit</a>
          <form action="/dashboard/posts/{{ $postUser->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger mt-3" onclick="return confirm('Apakah Anda Yakin Akan Mendelete Salah Satu Postingan Anda ?')">
              <span data-feather="trash-2"></span> Delete
            </button>
          </form>
        </div>
      </div>
    </div>
  
@endsection