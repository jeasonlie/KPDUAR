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
        $barangkeluar = BarangKeluar::with('BarangKeluarDetail', 'BarangKeluarDetail.Barang')->get();
        $barang = Barang::where('is_deleted', '=', '0')->get();
        return view('barangkeluar.index', compact('barang','barangkeluar'));
    }

    public function store(Request $request){
        try {
            $barang = DB::select('
            SELECT barang.*, IFNULL(masuk_detail.total_masuk, 0) AS total_masuk, IFNULL(keluar_detail.total_keluar, 0) AS total_keluar
            FROM `barang` 
            LEFT JOIN (SELECT barangmasukdetail.id_barang, SUM(barangmasukdetail.jumlah_barang) AS total_masuk FROM barangmasukdetail GROUP BY barangmasukdetail.id_barang) AS masuk_detail ON masuk_detail.id_barang = barang.id
            LEFT JOIN (SELECT barangkeluardetail.id_barang, SUM(barangkeluardetail.jumlah_barang) AS total_keluar FROM barangkeluardetail GROUP BY barangkeluardetail.id_barang) AS keluar_detail ON keluar_detail.id_barang = barang.id;
            ');

                for($i = 0; $i < count($request->id_barang); $i++){
                    $barang2 = $barang[array_search($request->id_barang[$i], array_column($barang, 'id'))];
                    $total = $barang2->total_masuk - $barang2->total_keluar;

                    if ($total-$request->jumlah_barang[$i] < 0) {
                        Session::flash('error', 'Stock Barang '.$barang2->nama_barang.' Kurang!'); 

                        return redirect()->route('barangkeluar.index');
                    };
                };

            DB::beginTransaction(); 
            $barangkeluar = new barangKeluar();
            $barangkeluar->tanggal = $request->tanggal_keluar;
            $barangkeluar->id_user = Auth::user()->id;
            $barangkeluar->save();


            for ($i=0; $i < count($request->id_barang); $i++) {
                $barangkeluardetail = new BarangKeluarDetail();
                $barangkeluardetail->id_barangkeluar = $barangkeluar->id;
                $barangkeluardetail->id_barang = $request->id_barang[$i];
                $barangkeluardetail->jumlah_barang = $request->jumlah_barang[$i]; 
                $barangkeluardetail->keterangan_keluar = $request->keterangan_keluar[$i];
                $barangkeluardetail->save();
            }

            DB::commit();
            Session::flash('message', 'Barang Keluar berhasil disimpan!'); 

            return redirect()->route('barangkeluar.index');
        }catch (\Exception $error) {
            DB::rollBack();
            dd($error);
            Session::flash('message', 'Barang Keluar gagal disimpan!'); 
            return redirect()->route('barangkeluar.index');
        }
    }

    public function edit($id) {
        $barangkeluar = barangKeluar::find($id);
        return view('barangkeluar.edit',compact('barangkeluar'));
    }

    public function update(Request $request, $id) {
        try {
            $barang = DB::select('
            SELECT barang.*, IFNULL(masuk_detail.total_masuk, 0) AS total_masuk, IFNULL(keluar_detail.total_keluar, 0) AS total_keluar
            FROM `barang` 
            LEFT JOIN (SELECT barangmasukdetail.id_barang, SUM(barangmasukdetail.jumlah_barang) AS total_masuk FROM barangmasukdetail GROUP BY barangmasukdetail.id_barang) AS masuk_detail ON masuk_detail.id_barang = barang.id
            LEFT JOIN (SELECT barangkeluardetail.id_barang, SUM(barangkeluardetail.jumlah_barang) AS total_keluar FROM barangkeluardetail GROUP BY barangkeluardetail.id_barang) AS keluar_detail ON keluar_detail.id_barang = barang.id;
            ');

                for($i = 0; $i < count($request->id_barang); $i++){
                    $barang2 = $barang[array_search($request->id_barang[$i], array_column($barang, 'id'))];
                    $total = $barang2->total_masuk - $barang2->total_keluar;
                    
                    if ($total-$request->jumlah_barang[$i] < 0) {

                        Session::flash('error', 'Stock Barang '.$barang2->nama_barang.' Kurang!'); 

                        return redirect()->route('barangkeluar.index');
                    };
                };

            DB::beginTransaction();
            $barangkeluar = barangKeluar::find($id);
            $barangkeluar->tanggal = $request->tanggal_keluar;
            $barangkeluar->save();
            
            for ($i=0; $i<count($request->id); $i++) { 
                $barangkeluardetail = BarangKeluarDetail::find($request->id[$i]);
                $barangkeluardetail->jumlah_barang = $request->jumlah_barang[$i];
                $barangkeluardetail->keterangan_keluar = $request->keterangan_keluar[$i];
                $barangkeluardetail->save();
            }

            DB::commit();
            Session::flash('message','Barang keluar berhasil disimpan!');
            return redirect()->route('barangkeluar.index');
            
        } catch (\Exception $error) {
            DB::rollBack();
            Session::flash('message','Barang keluar gagal disimpan!');
            return redirect()->route('barangkeluar.index');
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

    public function print($id) {
        $barangkeluar = barangKeluar::find($id);
        return view('barangkeluar.print',compact('barangkeluar'));
    }
}
