<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use Session;

class BarangController extends Controller
{
    public function index() {
        $barang = Barang::where('is_deleted', '=', '0')->get();
        $kategori = Kategori::all();
        return view('barang.index', compact('barang','kategori'));
    }

    public function store(Request $request) {
        $barang = new Barang();
        $barang->nama_barang = $request->nama_barang;
        $barang->id_kategori = $request->id_kategori;
        $barang->save();
        return redirect()->route('barang.index');
    }

    public function edit($id) {
        $barang = Barang::find($id);
        $kategori = Kategori::all();
        return view('barang.edit', compact('barang','kategori'));
    }

    public function update(Request $request, $id) {
        $barang = Barang::find($id);
        $barang->nama_barang = $request->nama_barang;
        $barang->id_kategori = $request->id_kategori;
        $barang->save();
        
        return redirect()->route('barang.index');
    }

    public function destroy($id) {
        $barang = Barang::find($id);
        $barang->is_deleted = 1;
        $barang->save();

        Session::flash('message', 'Barang berhasil dihapus!');
        return redirect()->route('barang.index');
    }
}
