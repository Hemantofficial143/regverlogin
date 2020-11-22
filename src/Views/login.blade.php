@extends('regverlogin::base')

@section('title')
Login
@endsection

@section('content')
<div class="container">
      
    <div class="row">
      <div class="col-md-12 card m-5 p-5">
        @if(\Session::has('success'))
          <div class="alert alert-success">{{ \Session::get('success') }}</div>
        @endif
        @if(count($errors))
          <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        @endif
        <div class="text-center h2">Login Page</div>
            <form action="{{route('login.post')}}" method="post">
              @csrf
                <div class="form-group">
                  <label for="Email">Email</label>
                  <input type="text"
                    class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Email">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password"
                    class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-success">Login</button>
                <a href="{{ route('forgot') }}">Forgot Password ??</a>
            </form>

        </div>
    </div>
</div>
@endsection
