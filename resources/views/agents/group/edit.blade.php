@extends('layouts.admin')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Ubah</h3>
    </div>
    {!! Form::model($data, ['method' => 'PATCH','url' => ['agent/groups', $data->grpagen_id],'role' => 'form', 'class' => 'form-horizontal']) !!}
        <div class="box-body">
            {{ Form::inputText('grpagen_name', 'Kelompok Agen', 'id-card', 'grpagen_name', ['required' => 'required']) }}
        </div>
        @permission('update-agent-groups')
        <div class="box-footer">
            {{ Form::btnSave('agent/groups') }}
        </div>
        @endpermission
    {!! Form::close() !!}
</div>
@endsection
