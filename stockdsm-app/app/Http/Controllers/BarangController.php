<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index() {
        $barang = Barang::all();
        return view('barang', compact('barang'));
    }

    public function store(Request $request) {
        $barang = new Barang();
        $barang->nama_barang = $request->nama_barang;
        $barang->kategori = $request->kategori;
    }

    public function update(Request $request, $id) {
        $barang->Barang::find($id);
        $barang->nama_barang = $request->nama_barang;
        $barang->kategori = $request->kategori;
        $barang->save();
    }

    public function destroy($id) {
        $barang->Barang::find($id);
        $barang->is_deleted = 1;
        $barang->save();

        Session::flash('message', 'Barang berhasil dihapus!');
        return redirect()->route('barang');
    }
}
