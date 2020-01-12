@extends('layouts.admin')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Tambah</h3>
    </div>
    {!! Form::open(['url' => 'status/worksheets', 'role' => 'form', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
        {{ Form::inputText('name', 'Nama', 'id-card', 'name', ['required' => 'required']) }}
        {{ Form::inputText('display_name', 'Keterangan Nama', 'id-card', 'display_name', ['required' => 'required']) }}
    </div>
    <div class="box-footer">
        {{ Form::btnSave('status/worksheets') }}
    </div>
    {!! Form::close() !!}
</div>
@endsection
