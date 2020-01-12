@extends('layouts.admin')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Tambah Pengguna</h3>
    </div>
    {!! Form::open(['url' => 'auth/users', 'role' => 'form', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
        {{ Form::inputText('name', 'Nama Pengguna', 'id-card-o', 'name', ['required' => 'required']) }}
        {{ Form::inputText('username', 'Username', 'id-card-o', 'username') }}
        {{ Form::inputEmail('email', 'Email', 'envelope', 'email', ['required' => 'required']) }}
        {{ Form::inputPassword('password', 'Password', 'key', 'password', ['required' => 'required']) }}
        {{ Form::inputSelect('group_id', 'Grup/Kelompok', 'list', 'group_id', $groups, ['required'=>'required']) }}
        @permission('read-auth-roles')
            {{ Form::inputSelect('roles', 'Role/Level', 'list', 'roles', $roles, ['required'=>'required']) }}
        @endpermission
    </div>
    <div class="box-footer">
        {{ Form::btnSave('auth/users') }}
    </div>
    {!! Form::close() !!}
</div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#group_id').select2({placeholder: '- Pilih -', width:'100%'});
            $('#roles').select2({placeholder: '- Pilih -', width:'100%'});
        });
    </script>
@endpush
