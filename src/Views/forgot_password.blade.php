@extends('regverlogin::base')

@section('title')
Forgot Password
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
        <div class="text-center h2">Forgot Password Page</div>
            <form action="{{route('forgot.post')}}" method="post">
              @csrf
                <div class="form-group">
                  <label for="Email">Email</label>
                  <input type="text"
                    class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Email">
                </div>
                <button type="submit" class="btn btn-success">Reset Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
