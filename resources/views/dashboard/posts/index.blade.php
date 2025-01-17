@extends('dashboard.layouts.main')

@section('container')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  
    <h1 class="h2">My Post</h1>
  </div>
  
  @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>
  @endif
  
  <div class="table-responsive col-lg-10">
    <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create New Post</a>
    <table class="table table-striped table-sm">
      <thead class="bg-primary text-light text-center">
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Title Post</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="bg-dark">
        @foreach ($postsUser as $post)
          <tr class="text-light">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->name }}</td>
            <td>
              <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info text-dark mb-2"><span data-feather="eye"></span></a>
              
              <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-primary text-dark mb-2"><span data-feather="edit"></span></a>
              
              <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger text-dark mb-2 border-0" onclick="return confirm('Apakah Anda Yakin Akan Mendelete Salah Satu Postingan Anda ?')">
                  <span data-feather="trash-2"></span>
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  
@endsection