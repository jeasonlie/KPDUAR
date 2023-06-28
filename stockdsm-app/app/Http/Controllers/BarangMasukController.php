<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;

class BarangMasukController extends Controller
{
    public function index() {
        $barangmasuk = BarangMasuk::all();
        return view('barangmasuk', compact('barangmasuk'));
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            $barangmasuk = new barangMasuk();
            $barangmasuk->tanggal_masuk = $request->tanggal_masuk;
            $barangkeluar->id_user = Auth::user()->id;
            $barangmasuk->save();
            
            for ($i=0; $i<count($request->barangmasuk); $i++) { 
                $barangmasukdetail = new barangMasukDetail();
                $barangmasukdetail->id_barangmasuk = $barangmasuk->id;
                $barangmasukdetail->id_barang = $request->id_barang[$i];
                $barangmasukdetail->jumlah_barang = $request->jumlah_barang[$i];
                $barangmasukdetail->keterangan_masuk = $request->keterangan_masuk[$i];
                $barangmasukdetail->save();
            }

            DB::commit();
            Session::flash('message','Barang masuk berhasil disimpan!');
            return redirect()->route('barang');

        } catch (\Exception $error) {
            DB::rollBack();
            Session::flash('message','Barang masuk gagal disimpan!');
            return redirect()->route('barang');
        }
    }

    public function update(Request $request) {
        try {
            DB::beginTransaction();
            $barangmasuk = barangMasuk::find($id);
            $barangmasuk->tanggal_masuk = $request->tanggal_masuk;
            $barangmasuk->save();
            
            for ($i=0; $i<count($request->barangmasuk); $i++) { 
                $barangmasukdetail = new barangMasukDetail();
                $barangmasukdetail->id_barangmasuk = $barangmasuk->id;
                $barangmasukdetail->id_barang = $request->id_barang[$i];
                $barangmasukdetail->jumlah_barang = $request->jumlah_barang[$i];
                $barangmasukdetail->keterangan_masuk = $request->keterangan_masuk[$i];
                $barangmasukdetail->save();
            }

            DB::commit();
            Session::flash('message','Barang keluar berhasil disimpan!');
            return redirect()->route('barang');
            
        } catch (\Exception $error) {
            DB::rollBack();
            Session::flash('message','Barang keluar gagal disimpan!');
            return redirect()->route('barang');
        }
    }
    
    public function destroy($id) {
        $barangmasuk = barangMasuk::find($id);
        $barangmasuk->delete();

        Session::flash('message','Barang keluar berhasil dihapus!');
        return redirect()->route('barangMasuk');
    }
}
