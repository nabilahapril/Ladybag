@extends('layouts.admin')

@section('title')
    <title>Laporan Order</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Laporan Order</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Laporan Order
                            </h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('report.order') }}" method="get">
                                <div class="input-group mb-3 col-md-4 float-right">
                                    <input type="text" id="created_at" name="date" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">Filter</button>
                                    </div>
                                    <a target="_blank" class="btn btn-primary ml-2" id="exportpdf">Export PDF</a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pelanggan</th>
                                            <th>Subtotal</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 0;?>
                                        @forelse ($payments as $row)
                                        <?php $no++ ;?>
                                                    <tr>
                                                        <td>{{ $no }}</td>
                                            <td>
                                                <label>Nama:</strong>{{$row->user->fullname}}
                                                <label><strong>Telp:</strong> {{ $row->phone }}</label><br>
                                                <label><strong>Alamat:</strong> {{ $row->address }} - {{ $row->district->name }} </label>
                                            </td>
                                            <td>Rp {{ number_format($row->total) }}</td>
                                           
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        $(document).ready(function() {
            let start = moment().startOf('month')
            let end = moment().endOf('month')

            $('#exportpdf').attr('href', '/reports/order/pdf/' + start.format('DD-MM-YYYY') + '+' + end.format('DD-MM-YYYY'))
            $('#created_at').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                $('#exportpdf').attr('href', '/reports/order/pdf/' + first.format('DD-MM-YYYY') + '+' + last.format('DD-MM-YYYY'))
            })
        })
    </script>
@endsection()