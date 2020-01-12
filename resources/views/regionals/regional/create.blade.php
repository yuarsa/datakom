@extends('layouts.admin')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Tambah</h3>
    </div>
    {!! Form::open(['url' => 'regional/regionals', 'role' => 'form', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
        {{ Form::inputText('reg_display_name', 'Regional', 'id-card', 'reg_display_name', ['required' => 'required']) }}
    </div>
    <div class="box-footer">
        {{ Form::btnSave('regional/regionals') }}
    </div>
    {!! Form::close() !!}
</div>
@endsection
