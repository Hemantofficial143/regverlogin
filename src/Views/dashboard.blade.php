@extends('regverlogin::base')

@section('title')
Dashboard
@endsection

@section('content')
    <div class="container">
        {{Auth::user()->name}}
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
    </div>
@endsection
