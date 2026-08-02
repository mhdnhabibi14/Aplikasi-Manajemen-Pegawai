<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use Illuminate\Http\Request;

class BagianController extends Controller
{
    public function index()
    {
        $bagians = Bagian::all();
        $title = 'Konfirmasi Hapus Data Bagian';
        $text = "Data akan dihapus secara permanen, lanjutkan?";
        confirmDelete($title, $text);
        return view('bagian.index', compact('bagians'));
    }

    public function Show(String $id)
    {
        $bagian = Bagian::find($id);
        return view('bagian.show', compact('bagian'));
    }

    public function destroy(String $id)
    {
        $bagian = Bagian::find($id);
        $bagian->delete();
        
        toast('Data bagian berhasil dihapus!','success');
        return redirect()->route('bagian.index');
    }

}
