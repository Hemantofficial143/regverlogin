@extends('regverlogin::base')

@section('title')
Registration
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
        <div class="text-center h2">Registration Page</div>
            <form action="{{route('register.post')}}" method="post">
              @csrf
                <div class="form-group">
                  <label for="Name">Name</label>
                  <input type="text"
                    class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Name">
                </div>
                <div class="form-group">
                  <label for="Email">Email</label>
                  <input type="text"
                    class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Email">
                </div>
                <div class="form-group">
                  <label for="Password">Password</label>
                  <input type="password"
                    class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="Confirm Password">Confirm Password</label>
                  <input type="password"
                    class="form-control" name="confirm_password" id="confirm_password" aria-describedby="helpId" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>
@endsection
