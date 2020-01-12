@extends('layouts.admin')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Tambah</h3>
    </div>
    {!! Form::open(['url' => 'regional/witels', 'role' => 'form', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
        {{ Form::inputSelect('witel_regional_id', 'Regional', 'list', null, $regional, ['placeholder' => '- Pilih -']) }}

        {{ Form::inputText('witel_display_name', 'Witel', 'id-card', 'witel_display_name', ['required' => 'required']) }}
    </div>
    <div class="box-footer">
        {{ Form::btnSave('regional/witels') }}
    </div>
    {!! Form::close() !!}
</div>
@endsection
