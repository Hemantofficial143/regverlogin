@extends('regverlogin::base')

@section('title')
Reset Password  
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
        <div class="text-center h2">Reset Password Page</div>
            <form action="/reset-password/{{ $token }}" method="post">
              @csrf
                <div class="form-group">
                  <label for="New Password">New Password</label>
                  <input type="password"
                    class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="Name">Confirm Password</label>
                    <input type="password"
                      class="form-control" name="confirm_password" id="confirm_password" aria-describedby="helpId" placeholder="Confirm Password">
                  </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
