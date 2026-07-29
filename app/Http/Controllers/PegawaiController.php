<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('pegawai.index', compact('pegawai'));
    }
    public function create()
    {
        return view('pegawai.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_pegawai' => 'required',
            'nik' => 'required|numeric|unique:pegawais,nik',
            'umur' => 'required|numeric',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
        ],[
            'nama_pegawai.required' => 'Nama Pegawai Wajib diisi',
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
        ]);

        Pegawai::create([
            'nama_pegawai' => $request->nama_pegawai,
            'nik' => $request->nik,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat' => $request->alamat,
            
        ]);
        // Pegawai::create($request->all());
        return redirect()->route('pegawai.index');
    }



    //Edit Data Pegawai
    public function edit(String $id)
    {
        $pegawai = Pegawai::find($id);
        return view('pegawai.edit', compact('pegawai'));
    }
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'nik' => 'required|numeric|unique:pegawais,nik,' . $pegawai->id,
            'umur' => 'required|numeric',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
        ], [
            'nama_pegawai.required' => 'Nama Pegawai Wajib diisi',
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
        ]);

        // $pegawai->update([
        //     'nama_pegawai' => $request->nama_pegawai,
        //     'umur' => $request->umur,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        //     'tanggal_lahir' => $request->tanggal_lahir,
        //     'tempat_lahir' => $request->tempat_lahir,
        //     'alamat' => $request->alamat,
            
        // ]);

        $pegawai->update($request->except('nik'));

        //$pegawai->update($request->all());
        return redirect()->route('pegawai.index');
    }
}
