@extends('layouts.mantis')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Users</h4>
        </div>
        <div class="card-body">
            <table class="table table-sm" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role->role_name ?? 'No Role'}}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#roleModal{{$user->id}}">Ganti Role</button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @foreach ($users as $user)
    <div class="modal fade" id="roleModal{{$user->id}}" tabindex="-1" aria-labelledby="roleModalLabel{{$user->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="roleModalLabel{{$user->id}}">Ganti Role</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="my-2 text-center text-secondary">Mengganti Role Dapat Merubah Hak Akses Dari User, Klik Ganti Role Unntuk Melanjutkan Perintah Ini</p>
                    <form action="{{ route('users.update-role') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div>
                            <label for="role_id">Tentukan Role Akses</label>
                            <select name="role_id" id="role_id" class="form-control">
                                <option value="">Pilih Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id}}">{{ $role->role_name }}</option>>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mt-2 w-100">Ganti Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection