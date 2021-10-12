@extends('layouts.admin')

@section('title')
    <title>Tambah Gambar</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Galeri</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{ route('image.store') }}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Gambar</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="warna">Warna</label>
                                    <input type="text" name="warna" class="form-control" value="{{ old('warna') }}" required>
                                    <p class="text-danger">{{ $errors->first('warna') }}</p>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                             
                                <div class="form-group">
                                    <label for="product_id">Produk</label>
                                    <select name="product_id" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($product as $row)
                                        <option value="{{ $row->id }}" {{ old('product_id') == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('product_id') }}</p>
                                </div>
                              
                               
                                <div class="form-group">
                                    <label for="file">Foto Produk</label>
                                    <input type="file" name="file" class="form-control" value="{{ old('uploadedFileUrl') }}">
                                    <p class="text-danger">{{ $errors->first('uploadedFileUrl') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection