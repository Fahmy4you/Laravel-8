@extends('../layouts.main')

@section('container')
  
    <div class="row justify-content-center">
      <div class="col-lg-10">
        
        <main class="form-registration">
          <h1 class="text-center h3 mb-3 fw-normal">Registration Form</h1>
          
          <form action="/register" method="post">
            @csrf
            <div class="form-floating">
              <input type="text" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="name" name="name" value="{{ old('name') }}">
              <label for="name">Name</label>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-floating">
              <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="{{ old('username') }}">
              <label for="username">Username</label>
              @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-floating">
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="emailAdd" placeholder="name@example.com" name="email" value="{{ old('email') }}">
              <label for="emailAdd">Email address</label>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-floating">
              <input type="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password">
              <label for="password">Password</label>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <button class="mt-3 w-100 btn btn-lg btn-primary" type="submit">Register</button>
          </form>
          <h6 class="d-block text-center mt-3">Already Registered? <a href="/login" class="text-decoration-none">Login!</a></h6>
        </main>
        
      </div>
    </div>
  
@endsection