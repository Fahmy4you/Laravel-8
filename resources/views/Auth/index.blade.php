@extends('../layouts.main')

@section('container')
  
    <div class="row justify-content-center">
      <div class="col-md-10">
        
        <main class="form-signin">
          <h1 class="text-center h3 mb-3 fw-normal">Please Login</h1>
          
          @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          
          @if(session()->has('successLogout'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('successLogout') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          
          @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('loginError') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          
          <form action="/login" method="post">
            @csrf
            <div class="form-floating">
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" name="email" autofocus value="{{ old('email') }}">
              <label for="email">Email address</label>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-floating">
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password">
              <label for="password">Password</label>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
          </form>
          <h6 class="d-block text-center mt-3">Not Registered? <a href="/register" class="text-decoration-none">Register Now!</a></h6>
        </main>
        
      </div>
    </div>
  
@endsection