<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index() {
        $barangkeluar = BarangKeluar::all();
        return view('barangkeluar', compact('barangkeluar'));
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            $barangkeluar = new barangKeluar();
            $barangkeluar->tanggal_keluar = $request->tanggal_keluar;
            $barangkeluar->save();
            
            for ($i=0; $i<count($request->barangKeluar); $i++) { 
                $barangkeluardetail = new barangKeluarDetail();
                $barangkeluardetail->id_barangkeluar = $barangkeluar->id;
                $barangkeluardetail->id_barang = $request->id_barang[$i];
                $barangkeluardetail->jumlah_barang = $request->jumlah_barang[$i];
                $barangkeluardetail->keterangan_masuk = $request->keterangan_masuk[$i];
                $barangkeluardetail->save();
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

    public function update(Request $request) {
        try {
            DB::beginTransaction();
            $barangkeluar = barangKeluar::find($id);
            $barangkeluar->tanggal_keluar = $request->tanggal_keluar;
            $barangkeluar->save();
            
            for ($i=0; $i<count($request->barangKeluar); $i++) { 
                $barangkeluardetail = new barangKeluarDetail();
                $barangkeluardetail->id_barangkeluar = $barangkeluar->id;
                $barangkeluardetail->id_barang = $request->id_barang[$i];
                $barangkeluardetail->jumlah_barang = $request->jumlah_barang[$i];
                $barangkeluardetail->keterangan_masuk = $request->keterangan_masuk[$i];
                $barangkeluardetail->save();
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
}
