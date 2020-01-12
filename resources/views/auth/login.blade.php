@extends('layouts.login')
@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" required placeholder="Username" autofocus autocomplete="off">
        <span class="fa fa-user-circle form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" required placeholder="Password">
        <span class="fa fa-key form-control-feedback"></span>
    </div>
    <div class="form-group mb-0 text-center">
        <button class="btn btn-block btn-rounded btn-login" type="submit"> Log In </button>
    </div>
</form>
@endsection
