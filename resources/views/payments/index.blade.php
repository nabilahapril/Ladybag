@extends('layouts.admin')

@section('title')
    <title>Daftar Pesanan</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">payments</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Daftar Pesanan
                            </h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('payments.index') }}" method="get">
                                <div class="input-group mb-3 col-md-6 float-right">
                                    <select name="status_id" class="form-control mr-3">
                                        <option value="">Pilih Status</option>
                                        <option value="1">Proses</option>
                                        <option value="2">Dikirim</option>
                                        <option value="3">Selesai</option>
                                    </select>
                                  
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pelanggan</th>
                                            <th>Total</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        <?php $no = 0;?>
                                        @forelse ($payments as $row)
                                        <?php $no++ ;?>
                                                    <tr>
                                                        <td>{{ $no }}</td>
                                            <td>
                                            <label><strong>Nama:</strong> {{ $row->user->username }}</label><br>
                                                <label><strong>Telp:</strong> {{ $row->phone }}</label><br>
                                                <label><strong>Alamat:</strong> {{ $row->address }} {{ $row->district->name }} </label>
                                            </td>
                                            <td>Rp {{ number_format($row->total) }}</td>
                                            <td>{{ $row->created_at}}</td>
                                            <td>
                                            {{ $row->status->status }} <br>
                                               
                                            </td>
                                            <td>
                                            
                                                <form action="{{ route('payments.destroy', $row->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    @if ($row->status_id == 2)
                                            <a href="{{ route('payments.approve_payment', $row->id) }}" class="btn btn-primary btn-sm">Terima Pembayaran</a>
                                            @endif
                                                         <a href="{{ route('payments.view', $row->id) }}" class="btn btn-warning btn-sm">Lihat</a>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {!! $payments->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
