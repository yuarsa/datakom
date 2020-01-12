@extends('layouts.admin')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Ubah</h3>
    </div>
    {!! Form::model($data, ['method' => 'PATCH','url' => ['status/worksheets', $data->id],'role' => 'form', 'class' => 'form-horizontal']) !!}
        <div class="box-body">
            {{ Form::inputText('name', 'Nama', 'id-card', 'name', ['required' => 'required']) }}
            {{ Form::inputText('display_name', 'Keterangan Nama', 'id-card', 'display_name', ['required' => 'required']) }}
        </div>
        @permission('update-worksheet-status')
        <div class="box-footer">
            {{ Form::btnSave('status/worksheets') }}
        </div>
        @endpermission
    {!! Form::close() !!}
</div>
@endsection
