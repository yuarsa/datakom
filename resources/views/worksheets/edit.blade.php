@extends('layouts.admin')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Ubah</h3>
    </div>
    {!! Form::model($data, ['method' => 'PATCH','url' => ['worksheet/worksheets', $data->work_id],'role' => 'form', 'class' => 'form-horizontal']) !!}
        <div class="box-body">
            <div class="col-md-4" style="padding: 0">
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th>Nomor Order</th>
                        <td>{{ $order->order_id }}</td>
                    </tr>
                    <tr>
                        <th>Customer</th>
                        <td>{{ $order->nama_bc }}</td>
                    </tr>
                    <tr>
                        <th>Usia Order</th>
                        <td>{{ $order->kategori_usia_order }}</td>
                    </tr>
                    <tr>
                        <th>AM</th>
                        <td>{{ $order->li_createdby_name }}</td>
                    </tr>
                    <tr>
                        <th>Segmen</th>
                        <td>{{ $order->segmen }}</td>
                    </tr>
                    <tr>
                        <th>Regional SA</th>
                        <td>{{ $order->regional }}</td>
                    </tr>
                    <tr>
                        <th>Witel SA</th>
                        <td>{{ $order->witel }}</td>
                    </tr>
                    <tr>
                        <th>NCX Milestone</th>
                        <td>{{ $order->ncx_milestone }}</td>
                    </tr>
                    <tr>
                        <th>Tipe Order</th>
                        <td>{{ $order->order_sub_type }}</td>
                    </tr>
                    <tr>
                        <th>Status Order NCX</th>
                        <td>
                            <input type="hidden" name="work_li_status" value="{{ $order->li_status }}">
                            {{ $order->li_status }}
                        </td>
                    </tr>
                    <tr>
                        <th>Taskname WFM</th>
                        <td>{{ $order->description_wfm }}</td>
                    </tr>
                    <tr>
                        <th>Owner Group WFM</th>
                        <td>{{ $order->ownergroup_wfm }}</td>
                    </tr>
                    <tr>
                        <th>Status WFM</th>
                        <td>{{ $order->status_wfm }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-8">
                {{ Form::inputText('work_order_id', 'Order', 'id-card', 'work_order_id', ['disabled' => 'disabled']) }}
                {{ Form::inputSelect('work_symptomp', 'Symptomp', 'list', null, $symcomp, ['placeholder' => '- Pilih -']) }}
                {{ Form::inputText('work_klarifikasi', 'Klarifikasi', 'id-card', 'work_klarifikasi', ['required' => 'required']) }}
                {{ Form::inputText('work_tindak_lanjut', 'Tindak Lanjut', 'id-card', 'work_tindak_lanjut', ['required' => 'required']) }}
                {{ Form::inputText('work_rekomendasi', 'Rekomendasi', 'id-card', 'work_rekomendasi', ['required' => 'required']) }}
                {{ Form::inputText('work_progres', 'Progres Akhir', 'id-card', 'work_progres', ['required' => 'required']) }}
                {{ Form::inputSelect('work_status', 'Status Akhir', 'list', null, $status, ['placeholder' => '- Pilih -', 'required' => 'required']) }}
                {{ Form::inputTextarea('work_keterangan', 'Keterangan', 'work_keterangan', ['rows' => 3]) }}
            </div>
        </div>
        {{-- @permission('update-worksheets') --}}
        <div class="box-footer">
            {{ Form::btnSave('order/orders') }}
        </div>
        {{-- @endpermission --}}
    {!! Form::close() !!}
</div>
@endsection
