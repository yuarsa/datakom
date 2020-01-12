@extends('layouts.admin')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Tambah</h3>
    </div>
    {!! Form::open(['url' => 'agent/groups', 'role' => 'form', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
        {{ Form::inputText('grpagen_name', 'Kelompok Agen', 'id-card', 'grpagen_name', ['required' => 'required']) }}
    </div>
    <div class="box-footer">
        {{ Form::btnSave('agent/groups') }}
    </div>
    {!! Form::close() !!}
</div>
@endsection
