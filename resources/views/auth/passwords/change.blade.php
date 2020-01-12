@extends('layouts.admin')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Ubah Password</h3>
    </div>
    <form accept="{{ url('auth/change-password') }}" class="form-horizontal" method="post">
        @csrf
        <input type="hidden" name="_method" value="put">
        <div class="box-body">
            {{ Form::inputPassword('password', 'Password', 'key', 'password', ['required' => 'required']) }}
            {{ Form::inputPassword('password_confirmation', 'Konfirmasi Password', 'key', 'password_confirmation', ['required' => 'required']) }}
        </div>
        <div class="box-footer">
            {{ Form::btnSave('auth/change-password') }}
        </div>
    </form>
</div>
@endsection
