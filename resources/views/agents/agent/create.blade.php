@extends('layouts.admin')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Tambah</h3>
    </div>
    {!! Form::open(['url' => 'agent/agents', 'role' => 'form', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
        {{ Form::inputSelect('agen_grpagen_id', 'Kelompok', 'list', null, $kelompok, ['placeholder' => '- Pilih -']) }}

        {{ Form::inputText('agen_name', 'Agen', 'id-card', 'agen_name', ['required' => 'required']) }}

        {{ Form::inputEmail('agen_email', 'Email', 'envelope', 'agen_email', ['required' => 'required']) }}

        {{ Form::inputText('agen_phone', 'Telepon', 'phone', 'agen_phone', ['required' => 'required']) }}

        {{ Form::inputTextarea('agen_address', 'Alamat', 'agen_address', ['rows' => 3]) }}

        {{ Form::inputText('username', 'Username', 'id-card', 'username', ['required' => 'required']) }}

        {{ Form::inputPassword('password', 'Password', 'key', 'password', ['required' => 'required']) }}
    </div>
    <div class="box-footer">
        {{ Form::btnSave('agent/agents') }}
    </div>
    {!! Form::close() !!}
</div>
@endsection
