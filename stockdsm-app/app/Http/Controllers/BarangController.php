<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarDetail;
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

    public function show($id) {
        $barang = Barang::select('barang.*')->with('kategori')
        ->leftJoin(DB::raw('(SELECT barangmasukdetail.id_barang, SUM(barangmasukdetail.jumlah_barang) AS total_masuk FROM barangmasukdetail GROUP BY barangmasukdetail.id_barang) AS masuk_detail'), 'masuk_detail.id_barang', '=', 'barang.id')
        ->leftJoin(DB::raw('(SELECT barangkeluardetail.id_barang, SUM(barangkeluardetail.jumlah_barang) AS total_keluar FROM barangkeluardetail GROUP BY barangkeluardetail.id_barang) AS keluar_detail'), 'keluar_detail.id_barang', '=', 'barang.id')
        ->selectRaw('IFNULL(masuk_detail.total_masuk, 0) AS total_masuk, IFNULL(keluar_detail.total_keluar, 0) AS total_keluar')
        ->where('barang.id', '=', $id)
        ->first();
        $barangmasuk = BarangMasuk::select('barangmasuk.*', 'bmd.*')
        ->join(\DB::raw('(SELECT barangmasukdetail.id_barangmasuk, barangmasukdetail.id_barang, barangmasukdetail.jumlah_barang, barangmasukdetail.keterangan_masuk, barang.* FROM barangmasukdetail INNER JOIN barang ON barangmasukdetail.id_barang = barang.id  WHERE barangmasukdetail.id_barang = '.$id.') AS bmd'), 'bmd.id_barangmasuk', '=', 'barangmasuk.id')
        ->orderBy('tanggal', 'DESC')
        ->get();
        $barangkeluar = BarangKeluar::select('barangkeluar.*', 'bkd.*')
        ->join(\DB::raw('(SELECT barangkeluardetail.id_barangkeluar, barangkeluardetail.id_barang, barangkeluardetail.jumlah_barang, barangkeluardetail.keterangan_keluar, barang.* FROM barangkeluardetail  INNER JOIN barang ON barangkeluardetail.id_barang = barang.id WHERE barangkeluardetail.id_barang = '.$id.') AS bkd'), 'bkd.id_barangkeluar', '=', 'barangkeluar.id')
        ->orderBy('tanggal', 'DESC')
        ->get();
        return view('barang.show',compact('barang','barangmasuk','barangkeluar'));
    }

    public function destroy($id) {
        $barang = Barang::find($id);
        $barang->is_deleted = 1;
        $barang->save();

        Session::flash('message', 'Barang berhasil dihapus!');
        return redirect()->route('barang.index');
    }
}
