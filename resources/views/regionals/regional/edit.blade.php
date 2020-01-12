@extends('layouts.admin')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Ubah</h3>
    </div>
    {!! Form::model($data, ['method' => 'PATCH','url' => ['regional/regionals', $data->reg_id],'role' => 'form', 'class' => 'form-horizontal']) !!}
        <div class="box-body">
            {{ Form::inputText('reg_display_name', 'Regional', 'id-card', 'reg_display_name', ['required' => 'required']) }}
        </div>
        @permission('update-regionals')
        <div class="box-footer">
            {{ Form::btnSave('regional/regionals') }}
        </div>
        @endpermission
    {!! Form::close() !!}
</div>
@endsection
