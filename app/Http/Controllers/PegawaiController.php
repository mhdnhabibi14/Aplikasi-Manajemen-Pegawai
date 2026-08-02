<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::with('user')->get();
        return view('pegawai.index', compact('pegawai'));
    }
    public function create()
    {
        $bagians = Bagian::all();
        return view('pegawai.create', compact('bagians'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_pegawai' => 'required',
            'bagian_id' => 'required|exists:bagians,id',
            'email' => 'required|email|unique:users,email',
            'nik' => 'required|numeric|unique:pegawais,nik',
            'umur' => 'required|numeric',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'foto'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'required',
        ],[
            'nama_pegawai.required' => 'Nama Pegawai Wajib diisi',
            'bagian_id.required' => 'Bagian Pegawai Wajib dipilih',
            'bagian_id.exists' => 'Bagian Pegawai tidak valid',
            'email.required' => 'Email Wajib diisi',
            'email.email' => 'Email Tidak Valid',
            'email.unique' => 'Email Sudah Terdaftar',
            'nik.required' => 'NIK Pegawai Wajid diisi',
            'nik.numeric' => 'NIK Harus Berupa Angaka',
            'nik.unique' => 'NIK Sudah Terdaftar',
            'umur.required' => 'Umur Wajid diisi',
            'umur.numeric' => 'Umur Harus Berupa Angaka',
            'alamat.required' => 'Alamat Wajid diisi',
            'tanggal_lahir.required' => 'Tanggal Lahir Wajid diisi',
            'tanggal_lahir.date' => 'Tanggal Lahir Harus Berupa Tanggal',
            'tempat_lahir.required' => 'Tempat Lahir Wajid diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib diisi',
            'jenis_kelamin.in' => 'Jenis Kelamin Harus Laki-laki atau Perempuan',
            'foto.required' => 'Foto Wajib diupload',
            'foto.image' => 'File Foto Tidak Sesuai',
            'foto.mimes' => 'Format Foto Tidak Sesuai',
            'foto.max' => 'Ukuran Foto Terlalu Besar',
        ]);

        $foto = $request->file('foto');
        $fileName = Str::uuid() . '.' . $foto->getClientOriginalExtension();

        Storage::disk('public')->putFileAs('foto_pegawai', $foto, $fileName);
        $newRequest = $request->all();
        $newRequest['foto'] = $fileName;

        // Pegawai::create([
        //     'nama_pegawai' => $request->nama_pegawai,
        //     'nik' => $request->nik,
        //     'umur' => $request->umur,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        //     'tanggal_lahir' => $request->tanggal_lahir,
        //     'tempat_lahir' => $request->tempat_lahir,
        //     'alamat' => $request->alamat,
            
        // ]);
        $newData = Pegawai::create($newRequest);
        $user = User::create([
            'name' => $newData->nama_pegawai,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'pegawai_id' => $newData->id,
        ]);
        $newData->user_id = $user->id;
        $newData->save();

        toast('Data pegawai berhasil ditambahkan!', 'success');
        return redirect()->route('pegawai.index');
    }



    //Edit Data Pegawai
    public function edit(String $id)
    {
        $pegawai = Pegawai::find($id);
        $bagians = Bagian::all();
        return view('pegawai.edit', compact('pegawai', 'bagians'));
    }
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'bagian_id' => 'required|exists:bagians,id',
            'nik' => 'required|numeric|unique:pegawais,nik,' . $pegawai->id,
            'umur' => 'required|numeric',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'foto'=> 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'required',
        ], [
            'nama_pegawai.required' => 'Nama Pegawai Wajib diisi',
            'bagian_id.required' => 'Bagian Pegawai Wajib dipilih',
            'bagian_id.exists' => 'Bagian Pegawai tidak valid',
            'nik.required' => 'NIK Pegawai Wajid diisi',
            'nik.numeric' => 'NIK Harus Berupa Angaka',
            'nik.unique' => 'NIK Sudah Terdaftar',
            'umur.required' => 'Umur Wajid diisi',
            'umur.numeric' => 'Umur Harus Berupa Angaka',
            'alamat.required' => 'Alamat Wajid diisi',
            'tanggal_lahir.required' => 'Tanggal Lahir Wajid diisi',
            'tanggal_lahir.date' => 'Tanggal Lahir Harus Berupa Tanggal',
            'tempat_lahir.required' => 'Tempat Lahir Wajid diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib diisi',
            'jenis_kelamin.in' => 'Jenis Kelamin Harus Laki-laki atau Perempuan',
            'foto.required' => 'Foto Wajib diupload',
            'foto.image' => 'File Foto Tidak Sesuai',
            'foto.mimes' => 'Format Foto Tidak Sesuai',
            'foto.max' => 'Ukuran Foto Terlalu Besar',
        ]);

        // $pegawai->update([
        //     'nama_pegawai' => $request->nama_pegawai,
        //     'umur' => $request->umur,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        //     'tanggal_lahir' => $request->tanggal_lahir,
        //     'tempat_lahir' => $request->tempat_lahir,
        //     'alamat' => $request->alamat,
            
        // ]);
        $fileName = $pegawai->foto;
        $foto = $request->file('foto');

        if($foto) {
            $fileName = Str::uuid() . '.' . $foto->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('foto_pegawai', $foto, $fileName);
        } else {
            $fileName = $pegawai->foto; 
        }

        $newRequest = $request->except('nik');
        $newRequest['foto'] = $fileName;

        $pegawai->update($newRequest);

        //$pegawai->update($request->all());
        toast('Data pegawai berhasil diupdate!','success');
        return redirect()->route('pegawai.index');
    }

    public function destroy(String $id)
    {
        $pegawai = Pegawai::find($id);

        if($pegawai->foto != null){
            Storage::disk('public')->delete('foto_pegawai/'. $pegawai->foto);
        }

        $pegawai->delete();
        toast('Data pegawai berhasil dihapus!','success');
        return redirect()->route('pegawai.index');
    }
}
