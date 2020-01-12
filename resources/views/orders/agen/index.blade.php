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
            <a href="{{ url('order/orders') }}" class="btn btn-sm btn-default btn-refresh"><i class="fa fa-refresh"></i> Refresh</a>
        </div>
    </form>
</div>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Data Order {{ \Auth::user()->name }}</h3>
    </div>
    <div class="box-body table-responsive">
        <table id="table-data2" class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th style="width: 20px"></th>
                    <th class="search-filter">Nama BC</th>
                    <th class="search-filter">Order ID</th>
                    <th class="search-filter">Order Sub Type</th>
                    <th class="search-filter">Li Product Name</th>
                    <th class="search-filter">Li Milestone</th>
                    <th class="search-filter">Li Status</th>
                    <th class="search-filter">Harga Total</th>
                    <th class="search-filter">Segmen</th>
                    <th class="search-filter">Witel</th>
                    <th class="search-filter">Regional</th>
                    <th class="search-filter">Li Created By Name</th>
                    <th class="search-filter">Deskripsi Wfm</th>
                    <th class="search-filter">Status Wfm</th>
                    <th class="search-filter">Owner Group Wfm</th>
                    <th class="search-filter">Kategori Usia Order</th>
                    <th class="search-filter">Status Update</th>
                    <th class="search-filter">Group</th>
                    <th class="search-filter">Symptomp</th>
                    <th class="search-filter">Klarifikasi</th>
                    <th class="search-filter">Tindak Lanjut</th>
                    <th class="search-filter">Rekomendasi</th>
                    <th class="search-filter">Progress Akhir</th>
                    <th class="search-filter">Status Akhir</th>
                    <th class="search-filter">Keterangan</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
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

            $('#table-data2 thead tr').clone(true).appendTo( '#table-data2 thead' );

            $('#table-data2 thead tr:eq(1) th').each( function (i) {
                if(i != 0) {
                    var title = $(this).text();

                    $(this).html( '<input type="text" class="form-control input-sm">' );

                    $('input', this).on('keyup change', function() {
                        if (table.column(i).search() !== this.value) {
                            table
                                .column(i)
                                .search(this.value)
                                .draw();
                        }
                    });
                }
            } );
            
            var table = $('#table-data2').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                processing : true,
                serverSide : true,
                ajax: {
                    url: '{{ url('order/order_agent_data') }}',
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
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
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
                    { data: 'group', name: 'group' },
                    { data: 'symptomp', name: 'symptomp' },
                    { data: 'klarifikasi', name: 'klarifikasi' },
                    { data: 'tindaklanjut', name: 'tindaklanjut' },
                    { data: 'rekomendasi', name: 'rekomendasi' },
                    { data: 'progress', name: 'progress' },
                    { data: 'statusakhir', name: 'statusakhir' },
                    { data: 'keterangan', name: 'keterangan' }
                ]
            });

            $('#frmFilter').on('submit', function(e) {
                table.draw();

                e.preventDefault();
            });
        });
    </script>
@endpush
