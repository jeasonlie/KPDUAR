<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarDetail;
use DB;
use Session;

class BarangKeluarController extends Controller
{
    public function index() {
        $barangkeluar = BarangKeluar::with('BarangKeluarDetail', 'BarangKeluarDetail.Barang');
        $barang = Barang::where('is_deleted', '=', '0')->get();
        return view('barangkeluar.index', compact('barang','barangkeluar'));
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            $barangkeluar = new barangKeluar();
            $barangkeluar->tanggal_keluar = $request->tanggal_keluar;
            $barangkeluar->id_user = Auth::user()->id;
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
    
    public function show($id) {
        $barangkeluar = barangKeluar::find($id);
        return view('barangkeluar.show',compact('barangkeluar'));
    }

    public function destroy($id) {
        $barangkeluar = barangKeluar::find($id);
        $barangkeluar->delete();

        Session::flash('message','Barang keluar berhasil dihapus!');
        return redirect()->route('barangkeluar.index');
    }
}
