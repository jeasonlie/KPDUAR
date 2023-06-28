<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use DB;
use Session;

class BarangController extends Controller
{
    public function index() {
        $barang = Barang::select('barang.*')->with('kategori')
        ->leftJoin(DB::raw('(SELECT barangmasukdetail.id_barang, SUM(barangmasukdetail.jumlah_barang) AS total_masuk FROM barangmasukdetail GROUP BY barangmasukdetail.id_barang) AS masuk_detail'), 'masuk_detail.id_barang', '=', 'barang.id')
        ->leftJoin(DB::raw('(SELECT barangkeluardetail.id_barang, SUM(barangkeluardetail.jumlah_barang) AS total_keluar FROM barangkeluardetail GROUP BY barangkeluardetail.id_barang) AS keluar_detail'), 'keluar_detail.id_barang', '=', 'barang.id')
        ->selectRaw('IFNULL(masuk_detail.total_masuk, 0) AS total_masuk, IFNULL(keluar_detail.total_keluar, 0) AS total_keluar')
        ->where('is_deleted', 0)
        ->get();
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
