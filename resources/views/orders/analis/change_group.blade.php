@extends('layouts.admin')
@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-filter"></i> Filter</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <form method="post" id="frmFilter">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Segment</label>
                        {{ Form::select('segment_id', $segment, null, ['id' => 'segment_id', 'placeholder' => '- Pilih -', 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Regional</label>
                        {{ Form::select('regional_id', $regional, null, ['id' => 'regional_id', 'placeholder' => '- Pilih -', 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Witel</label>
                        {{ Form::select('witel_id', $witel, null, ['id' => 'witel_id', 'placeholder' => '- Pilih -', 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Produk</label>
                        {{ Form::select('produk_id', $produk, null, ['id' => 'produk_id', 'placeholder' => '- Pilih -', 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Usia Order</label>
                        {{ Form::select('usia_id', $usia, null, ['id' => 'usia_id', 'placeholder' => '- Pilih -', 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Li Status</label>
                        {{ Form::select('listatus_id', $listatus, null, ['id' => 'listatus_id', 'placeholder' => '- Pilih -', 'class' => 'form-control']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            {!! Form::button('<span class="fa fa-filter"></span> Filter', ['type' => 'submit', 'class' => 'btn btn-sm btn-info btn-filter']) !!}
            &nbsp;
            <a href="{{ url('order/change-group') }}" class="btn btn-sm btn-default btn-refresh"><i class="fa fa-refresh"></i> Refresh</a>
        </div>
    </form>
</div>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Data Kelompok/Grup</h3>
    </div>
    <form action="{{ url('order/change-group') }}" method="post">
        @csrf

        <input type="hidden" name="_method" value="put">

        <div class="box-body table-responsive">
            <div class="form-group" style="margin-bottom: 10px;">
                <select id="group_id" name="group_id" class="form-control" required>
                    <option value="">- Pilih -</option>
                    @foreach ($group as $item)
                        <option value="{{ $item->grpagen_id }}">{{ $item->grpagen_name }}</option>
                    @endforeach
                </select>
            </div>
            <table id="table-assign-order" class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th style="width: 20px" class="text-center"><input type="checkbox" name="cbPilihParent" class="cbPilihParent" value="0"></th>
                        <th>Nama BC</th>
                        <th>Order ID</th>
                        <th>Order Sub Type</th>
                        <th>Li Product Name</th>
                        <th>Li Milestone</th>
                        <th>Li Status</th>
                        <th>Harga Total</th>
                        <th>Segmen</th>
                        <th>Witel</th>
                        <th>Regional</th>
                        <th>Created By Name</th>
                        <th>Deskripsi Wfm</th>
                        <th>Status Wfm</th>
                        <th>Owner Group Wfm</th>
                        <th>Kategori Usia Order</th>
                        <th>Status Update</th>
                        <th>Group</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-sm btn-success">Ganti</button>&nbsp;
            <a href="{{ url('order/orders') }}" class="btn btn-sm btn-default"><span class="fa fa-times-circle"></span> &nbsp;Kembali</a>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
    $(function() {
		$('#segment_id').select2({placeholder: "- Pilih -", width:'100%'});
        $('#regional_id').select2({placeholder: "- Pilih -", width:'100%'});
        $('#witel_id').select2({placeholder: "- Pilih -", width:'100%'});
        $('#produk_id').select2({placeholder: "- Pilih -", width:'100%'});
        $('#usia_id').select2({placeholder: "- Pilih -", width:'100%'});
        $('#listatus_id').select2({placeholder: "- Pilih -", width:'100%'});
        $('#group_id').select2({placeholder: '- Pilih -', width:'100%'});

        $('#table-assign-order thead tr').clone(true).appendTo('#table-assign-order thead');

        $('#table-assign-order thead tr:eq(1) th').each(function(i) {
            if(i != 0) {
                var title = $(this).text();

                $(this).html('<input type="text" class="form-control input-sm" placeholder="Search '+ title +'" />');

                $('input', this).on('keyup change', function() {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            } else {
                $(this).html('');
            }
        });

        var table = $('#table-assign-order').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            processing : true,
            serverSide : true,
            lengthChange: false,
			ajax: {
                url: '{{ url('order/change_group') }}',
                data: function(d) {
                    d.segment_id = $('select[name=segment_id]').val();
                    d.regional_id = $('select[name=regional_id]').val();
                    d.witel_id = $('select[name=witel_id]').val();
                    d.produk_id = $('select[name=produk_id]').val();
                    d.usia_id = $('select[name=usia_id]').val();
                    d.listatus_id = $('select[name=listatus_id]').val();
                }
            },
            columns: [
                {
                    targets: 0,
                    data: null,
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    width: "5%",
                    render: function ( data, type, row ) {
                        return '<input type="checkbox" style="margin-top: 0;vertical-align: middle" name="order_id[]" class="cbPilih" value="'+ data.order_id +'|'+ data.li_status +'">';
                    }
                },
                { data: 'nama_bc', name: 'nama_bc' },
                { data: 'order_id', name: 'order_id' },
                { data: 'order_sub_type', name: 'order_sub_type' },
                { data: 'li_product_name', name: 'li_product_name' },
                { data: 'li_milestone', name: 'li_milestone' },
                { data: 'li_status', name: 'li_status' },
                { data: 'harga_total', name: 'harga_total', className: 'text-right' },
                { data: 'segmen', name: 'segmen' },
                { data: 'witel', name: 'witel' },
                { data: 'regional', name: 'regional' },
                { data: 'li_createdby_name', name: 'li_createdby_name' },
                { data: 'description_wfm', name: 'description_wfm' },
                { data: 'status_wfm', name: 'status_wfm' },
                { data: 'ownergroup_wfm', name: 'ownergroup_wfm' },
                { data: 'kategori_usia_order', name: 'kategori_usia_order' },
                { data: 'status_id', name: 'status_id' },
                { data: 'group', name: 'group' }
            ]
        });
		
		$('#frmFilter').on('submit', function(e) {
            table.draw();

            e.preventDefault();
        });

        $('body').on('click', '.cbPilihParent', function() {
            if((this).checked){
                $('.cbPilih').prop('checked', true);
            }else{
                $('.cbPilih').prop('checked', false);
            }
        });
    });
</script>
@endpush
