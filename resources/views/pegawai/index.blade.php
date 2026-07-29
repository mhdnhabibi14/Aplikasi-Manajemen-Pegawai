@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Form Data Pegawai</h4>
                    <div class="card-tools">
                        <a href="{{ route('pegawai.create') }}" class="btn btn-primary">Tambah Pegawai</a>
                    </div>    
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $index => $item)
                            <tr>
                                <td>{{ $index + 1}}</td>
                                <td>{{ $item->nama_pegawai }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->umur }}</td>
                                <td>{{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Aksi</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('pegawai.edit', $item->id)}}">Edit</a></li>
                                        </ul>
                                        </div>
                                </td>
                            </tr>
                        @endforeach    
                    </tbody>    
                </table>
            </div>
        </div>
    </div>
@endsection
