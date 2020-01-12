@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Monitoring</li>
        </ol>
    </section>
    <br>
    <section class="content">
        <div class="row">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Deliver Monitor</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="table-data" class="table table-bordered table-hover table-condensed">
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
        </div>
    </section>
</div>
@endsection
