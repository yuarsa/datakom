@extends('layouts.admin')
@section('content')
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Data Deliver Monitor</h3>
    </div>
    <div class="box-body table-responsive">
        <table id="table-data2" class="table table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>LAST REFRESH</th>
                    <th>NAMA BC</th>
                    <th>ORDER ID</th>
                    <th>ORDER SUBTYPE</th>
                    <th>LI SID</th>
                    <th>CUSTACCNTNUM</th>
                    <th>LI ID</th>
                    <th>LI PRODUCT NAME</th>
                    <th>KELOMPOK PRODUK</th>
                    <th>NEW BANDWIDTH</th>
                    <th>LI MILESTONE</th>
                    <th>NCX MILESTONE</th>
                    <th>LI_STATUS</th>
                    <th>BIAYA_PASANG</th>
                    <th>HRG_BULANAN</th>
                    <th>HARGA TOTAL</th>
                    <th>LAST_UPDATE</th>
                    <th>LAST UPDATE (BILLCOMP DATE)</th>
                    <th>BILLCOMP KATEGORI</th>
                    <th>SEGMEN</th>
                    <th>WITEL</th>
                    <th>REGIONAL</th>
                    <th>LI_CREATEDBY_NAME</th>
                    <th>ORDER_CREATED_DATE</th>
                    <th>USIA ORDER</th>
                    <th>KATEGORI USIA ORDER</th>
                    <th>TAHUN CREATE ORDER</th>
                    <th>DESCRIPTION_WFM</th>
                    <th>STATUS_WFM</th>
                    <th>OWNERGROUP_WFM</th>
                    <th>WONUM</th>
                    <th>PROVCOM_DATE</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#table-data2').DataTable({
                processing : true,
                serverSide : true,
                ajax : '{{ url('monitor/monitor_data') }}',
                columns: [
                    { data: 'last_refresh', name: 'last_refresh' },
                    { data: 'nama_bc', name: 'nama_bc' },
                    { data: 'order_id', name: 'order_id' },
                    { data: 'order_sub_type', name: 'order_sub_type' },
                    { data: 'li_sid', name: 'li_sid' },
                    { data: 'custanum', name: 'custanum' },
                    { data: 'li_id', name: 'li_id' },
                    { data: 'li_product_name', name: 'li_product_name' },
                    { data: 'kelompok_product', name: 'kelompok_product' },
                    { data: 'new_bandwidth', name: 'new_bandwidth' },
                    { data: 'li_milestone', name: 'li_milestone' },
                    { data: 'ncx_milestone', name: 'ncx_milestone' },
                    { data: 'li_status', name: 'li_status' },
                    { data: 'biaya_pasang', name: 'biaya_pasang' },
                    { data: 'hrg_bulanan', name: 'hrg_bulanan' },
                    { data: 'harga_total', name: 'harga_total' },
                    { data: 'last_update', name: 'last_update' },
                    { data: 'billcomp_update', name: 'billcomp_update' },
                    { data: 'billcomp_kategori', name: 'billcomp_kategori' },
                    { data: 'segmen', name: 'segmen' },
                    { data: 'witel', name: 'witel' },
                    { data: 'regional', name: 'regional' },
                    { data: 'li_createdby_name', name: 'li_createdby_name' },
                    { data: 'order_created_date', name: 'order_created_date' },
                    { data: 'usia_order', name: 'usia_order' },
                    { data: 'kategori_usia_order', name: 'kategori_usia_order' },
                    { data: 'tahun_created_order', name: 'tahun_created_order' },
                    { data: 'description_wfm', name: 'description_wfm' },
                    { data: 'status_wfm', name: 'status_wfm' },
                    { data: 'ownergroup_wfm', name: 'ownergroup_wfm' },
                    { data: 'wonum', name: 'wonum' },
                    { data: 'provcom_date', name: 'provcom_date' }
                ]
            });
        });
    </script>
@endpush
