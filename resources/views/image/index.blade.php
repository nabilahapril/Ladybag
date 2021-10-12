@extends('layouts.admin')

@section('title')
    <title>Galeri</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Galeri</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Galeri
                                <div class="float-right">
                                 
                                    <a href="{{ route('image.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('image.index') }}" method="get">
                                <div class="input-group mb-3 col-md-6 float-right">
                                    <select name="product_id" class="form-control mr-3">
                                        <option value="">Pilih Product</option>
                                        @foreach ($product as $row)
                                        <option value="{{ $row->id }}" {{ old('product_id') == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                       @endforeach
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
                                            <th>#</th>
                                            <th>Produk</th>
                                            <th>Warna</th>
                                        
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($image as $row)
                                        <tr>
                                            <td>
                                            <img src="{{$row->uploadedFileUrl}}"   width="100px" height="100px" alt="{{ $row->warna }}">
                                            </td>
                                            <td>
                                                <strong>{{ $row->name }}</strong><br>
                                                <label>Produk: <span class="badge badge-info">{{ $row->product->name }}</span></label><br>
                                            </td>
                                            <td>{{ $row->warna }}</td>
                                            <td>
                                                <form action="{{ route('image.destroy', $row->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('image.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
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
                            {!! $image->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
