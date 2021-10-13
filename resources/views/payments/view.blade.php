@extends('layouts.admin')

@section('title')
    <title>Detail pesanan</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">View payment</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Detail pesanan
                            </h4>
                            
                            <div class="float-right">
                                   
                                </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Detail Pelanggan</h4>
                                    <table class="table table-bordered">
                                    <tr>
                                            <th>Nama</th>
                                            <td>{{ $payment->user->username}}</td>
                                        </tr>
                                        <tr>
                                            <th>Telp</th>
                                            <td>{{ $payment->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $payment->address }} {{ $payment->district->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Status</th>
                                            <td>{{ $payment->status->status}}</td>
                                        </tr>
                                        @if ($payment->status_id == 1)
                                        <tr>
                                            
                                            <td>
                                               
                                                <form action="{{ route('payments.done') }}" method="post">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                                       
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary" type="submit">Kirim</button>
                                                        </div>
                                                    </div>
                                                </form>
                                               
                                             
                                            </td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                              
                                <div class="col-md-12">
                                    <h4>Detail Produk</h4>
                                    <table class="table table-bpaymentd table-hover">
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Style</th>
                                            <th>Quantity</th>
                                       
                                        </tr>
                                        @foreach ($line_item_clone as $row)
                                        <tr>
                                        <td>{{ $row->Image->product->name }}</td>
                                        <td>{{ $row->Image->warna }}</td>
                                            <td>{{ $row->quantity }}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
