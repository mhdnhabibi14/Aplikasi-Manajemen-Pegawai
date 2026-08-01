@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Tambah Pegawai</h4>
                <div class="card-tools">
                    <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-2">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        <input type="text" id="nama_pegawai" name="nama_pegawai" class="form-control 
                        @error('nama_pegawai') is-invalid @enderror" value="{{ old('nama_pegawai')}}" autoFocus>
                        @error('nama_pegawai') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control
                        @error('email') is-invalid @enderror" value="{{ old('email')}}" autocomplete="off">
                        @error('email') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="nik">NIK</label>
                        <input type="text" id="nik" name="nik" class="form-control
                        @error('nik') is-invalid @enderror" value="{{ old('nik')}}">
                        @error('nik') <small class="text-danger">{{ $message}}</small>@enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="umur">Umur</label>
                        <input type="number" id="umur" name="umur" class="form-control
                        @error('umur') is-invalid @enderror" value="{{old('umur')}}">
                        @error('umur') <small class="text-danger">{{ $message}}</small>@enderror
                    </div>
                    <div class= "form-group my-2">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control
                        @error('jenis_kelamin') is-invalid @enderror">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : ''}}>Laki-laki</option>
                            <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : ''}}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group my-2">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control
                        @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir')}}">
                        @error('tempat_lahir') <small class="text-danger">{{ $message}}</small>@enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control
                        @error ('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir')}}">
                        @error ('tanggal_lahir') <small class="text-danger">{{ $message}}</small>@enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="foto">Foto Pegawai</label>
                        <input type="file" id="foto" name="foto" class="form-control
                        @error ('foto') is-invalid @enderror">
                        @error ('foto') <small class="text-danger">{{ $message}}</small>@enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" cols="30" rows="10" class="form-control
                        @error ('alamat') is-invalid @enderror">{{ old('alamat')}}</textarea>
                        @error ('alamat') <small class="text-danger">{{ $message}}</small>@enderror
                    </div>
                    <div class="my-2 d-flex justify-content-end">
                        <button class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
