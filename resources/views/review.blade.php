@extends('layouts.admin')

@section('title')
    <title>Review</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Review</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Daftar Review
                            </h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                           
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Review</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        <?php $no = 0;?>
                                        @forelse ($feedbacks as $row)
                                        <?php $no++ ;?>
                                                    <tr>
                                                        <td>{{ $no }}</td>
                                            <td>
                                            <label><strong>Nama:</strong> {{ $row->name }}</label><br>
                                                
                                            </td>
                                            <td>
                                            <label><strong>Email:</strong> {{ $row->email }}</label>
                                            </td>
                                            <td> <label><strong>Judul:</strong> {{ $row->title}}</label><br>
                                                 <label><strong>Review:</strong> {{$row->review}}</label></td>
                                            
                                           
                                            <td>
                                           
                                                <form action="{{ route('review.destroy', $row->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                  
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
