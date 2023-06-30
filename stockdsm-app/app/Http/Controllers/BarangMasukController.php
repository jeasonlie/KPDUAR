<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;
use DB;
use Session;

class BarangMasukController extends Controller
{
    public function index() {
        $barangmasuk = BarangMasuk::with('BarangMasukDetail', 'BarangMasukDetail.Barang')->get();
        $barang = Barang::where('is_deleted', '=', '0')->get();
        return view('barangmasuk.index', compact('barang','barangmasuk'));
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            $barangmasuk = new barangMasuk();
            $barangmasuk->tanggal = $request->tanggal_masuk;
            $barangmasuk->id_user = Auth::user()->id;
            $barangmasuk->save();
            
            for ($i=0; $i<count($request->id_barang); $i++) { 
                $barangmasukdetail = new barangMasukDetail();
                $barangmasukdetail->id_barangmasuk = $barangmasuk->id;
                $barangmasukdetail->id_barang = $request->id_barang[$i];
                $barangmasukdetail->jumlah_barang = $request->jumlah_barang[$i];
                $barangmasukdetail->keterangan_masuk = $request->keterangan_masuk[$i];
                $barangmasukdetail->save();
            }

            DB::commit();
            Session::flash('message','Barang Masuk berhasil disimpan!');
            return redirect()->route('barangmasuk.index');

        } catch (\Exception $error) {
            DB::rollBack();
            Session::flash('message','Barang Masuk gagal disimpan!');
            return redirect()->route('barangmasuk.index');
        }
    }

    public function edit($id) {
        $barangmasuk = barangMasuk::find($id);
        return view('barangmasuk.edit',compact('barangmasuk'));
    }

    public function update(Request $request, $id) {
        try {
            DB::beginTransaction();
            $barangmasuk = barangMasuk::find($id);
            $barangmasuk->tanggal = $request->tanggal_masuk;
            $barangmasuk->save();
            
            for ($i=0; $i<count($request->id); $i++) { 
                $barangmasukdetail = barangMasukDetail::find($request->id[$i]);
                $barangmasukdetail->jumlah_barang = $request->jumlah_barang[$i];
                $barangmasukdetail->keterangan_masuk = $request->keterangan_masuk[$i];
                $barangmasukdetail->save();
            }

            DB::commit();
            Session::flash('message','Barang Masuk berhasil disimpan!');
            return redirect()->route('barangmasuk.index');
            
        } catch (\Exception $error) {
            DB::rollBack();
            Session::flash('message','Barang Masuk gagal disimpan!');
            return redirect()->route('barangmasuk.index');
        }
    }

    public function show($id) {
        $barangmasuk = barangMasuk::find($id);
        return view('barangmasuk.show',compact('barangmasuk'));
    }
    
    public function destroy($id) {
        $barangmasuk = barangMasuk::find($id);
        $barangmasuk->delete();

        Session::flash('message','Barang Masuk berhasil dihapus!');
        return redirect()->route('barangmasuk.index');
    }

    public function print($id) {
        $barangmasuk = barangMasuk::find($id);
        return view('barangmasuk.print',compact('barangmasuk'));
    }
}
