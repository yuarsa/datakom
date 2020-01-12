@extends('layouts.admin')
@section('content')
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Data Agen</h3>
    </div>
    <form action="{{ url('order/list-to-assigns') }}" method="post">
        @csrf
        <div class="box-body table-responsive">
            <div class="form-group" style="margin-bottom: 10px;">
                <select id="work_agen" name="work_agen" class="form-control" required>
                    <option value="">- Pilih -</option>
                    @foreach ($agent as $item)
                        <option value="{{ $item->agen_id }}">{{ $item->agen_name }}</option>
                    @endforeach
                </select>
            </div>
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th style="width: 45px">#</th>
                        <th>Order ID</th>
                        <th>Nama BC</th>
                        <th>Nama Produk</th>
                        <th>Milestone</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($orders)
                        @foreach ($orders as $item)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="work_order_id[]" value="{{ $item->order_id }}" style="margin-top: 0;vertical-align: middle">
                                </td>
                                <td>{{ $item->order_id }}</td>
                                <td>{{ $item->nama_bc }}</td>
                                <td>{{ $item->li_product_name }}</td>
                                <td>{{ $item->li_milestone }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-sm btn-success">Assign</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
    $(function() {
        $('#work_agen').select2({placeholder: '- Pilih -', width:'100%'});
    });
</script>
@endpush
