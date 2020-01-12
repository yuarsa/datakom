@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Status Order</h3>
            </div>
            <div class="box-body">
                <div class="table table-responsive table-bordered">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Total Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->status }}</td>
                                    <td class="text-center">{{ $item->total }}</td>
                                </tr>
                                @php
                                    $total += $item->total
                                @endphp
                            @endforeach
                            <tr>
                                <td>Blank</td>
                                <td class="text-center">{{ $total_all - $working_total }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total Order</th>
                                <td class="text-center"><strong>{{ $total + ($total_all - $working_total) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div id="container" style="margin-top: 10px;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Kamu Memiliki: {{ $total_all }} Order {{ $working_total }} Order</h3>
            </div>
            <div class="box-body">
                <div id="container2"></div>
            </div>
        </div>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Symptomp Order</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>Symptomp</th>
                                <th>Total Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total2 = 0
                            @endphp
                            @foreach ($data2 as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">{{ $item->total }}</td>
                                </tr>
                                @php
                                    $total2 += $item->total
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <td class="text-center"><strong>{{ $total2}}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div id="container" style="margin-top: 10px;"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('js/app/highcharts.js') }}"></script>
@endpush
@push('scripts')
<script>
    $(function() {
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Diagram'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Persentase',
                colorByPoint: true,
                data: [
                    @foreach($data as $row)
                        {
                            name: '{{ $row->status }}',
                            y: {{ $row->percent }}
                        },
				    @endforeach
                    {
                        name: 'Blank',
                        y: {{ $percent_blank }}
                    },
                ]
            }]
        });

        $('#container2').highcharts({
            chart: {
                type: 'bar'
            },
            xAxis: {
                categories: [''],
            },
            title: {
                text: 'Progress Pengerjaan Order'
            },
            yAxis: {
                min: 0,
                title: {
                    text: null
                },
                visible: false
            },
            legend: {
                reversed: true,
            },
            
            plotOptions: {
                series: {
                    stacking: 'normal'
                },
                bar: {
                    dataLabels: {
                        enabled: true,
                        distance : -50,
                        formatter: function() {
                            var dlabel = Math.round(this.percentage * 100) / 100 + ' %';
                                return dlabel
                        },
                        style: {
                            color: 'white'
                        },
                    },
                    
                },
            },
            series: [{
                name: 'Belum Dikerjakan',
                data: [{{ $total_all - $working_total }}]
            }, {
                name: 'Sudah Dikerjakan',
                data: [{{ $working_total }}]
            }]
        });
    });
</script>
@endpush