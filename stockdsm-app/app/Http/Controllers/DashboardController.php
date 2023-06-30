<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request) {
        // untuk menampilkan stok barang
        $barang = Barang::select('barang.*')->with('kategori')
        ->leftJoin(DB::raw('(SELECT barangmasukdetail.id_barang, SUM(barangmasukdetail.jumlah_barang) AS total_masuk FROM barangmasukdetail GROUP BY barangmasukdetail.id_barang) AS masuk_detail'), 'masuk_detail.id_barang', '=', 'barang.id')
        ->leftJoin(DB::raw('(SELECT barangkeluardetail.id_barang, SUM(barangkeluardetail.jumlah_barang) AS total_keluar FROM barangkeluardetail GROUP BY barangkeluardetail.id_barang) AS keluar_detail'), 'keluar_detail.id_barang', '=', 'barang.id')
        ->selectRaw('IFNULL(masuk_detail.total_masuk, 0) AS total_masuk, IFNULL(keluar_detail.total_keluar, 0) AS total_keluar')
        ->where('is_deleted', 0)
        ->get();

        $kategori = Kategori::all();
        $barangmasuk = BarangMasuk::all();
        $barangkeluar = BarangKeluar::all();

        
        $barangMasukData = BarangMasuk::select('id', 'tanggal', 'id_user', \DB::raw("'Masuk' AS keterangan"))->withCount('barangMasukDetail AS total_barang');
        $barangKeluarData = BarangKeluar::select('id', 'tanggal', 'id_user', \DB::raw("'Keluar' AS keterangan"))->withCount('barangKeluarDetail AS total_barang');

        //memfilter data berdasarkan tanggal
        $dateFilter = $request->date_filter;
        switch($dateFilter){
            case 'today':
                $barangMasukData->whereDate('tanggal',Carbon::today());
                $barangKeluarData->whereDate('tanggal',Carbon::today());
                break;
            case 'yesterday':
                $barangMasukData->wheredate('tanggal',Carbon::yesterday());
                $barangKeluarData->wheredate('tanggal',Carbon::yesterday());
                break;
            case 'this_week':
                $barangMasukData->whereBetween('tanggal',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()]);
                $barangKeluarData->whereBetween('tanggal',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()]);
                break;
            case 'last_week':
                $barangMasukData->whereBetween('tanggal',[Carbon::now()->subWeek(),Carbon::now()]);
                $barangKeluarData->whereBetween('tanggal',[Carbon::now()->subWeek(),Carbon::now()]);
                break;
            case 'this_month':
                $barangMasukData->whereMonth('tanggal',Carbon::now()->month);
                $barangKeluarData->whereMonth('tanggal',Carbon::now()->month);
                break;
            case 'last_month':
                $barangMasukData->whereMonth('tanggal',Carbon::now()->subMonth()->month);
                $barangKeluarData->whereMonth('tanggal',Carbon::now()->subMonth()->month);
                break;
            case 'this_year':
                $barangMasukData->whereYear('tanggal',Carbon::now()->year);
                $barangKeluarData->whereYear('tanggal',Carbon::now()->year);
                break;
            case 'last_year':
                $barangMasukData->whereYear('tanggal',Carbon::now()->subYear()->year);
                $barangKeluarData->whereYear('tanggal',Carbon::now()->subYear()->year);
                break;                       
        }

        //melakukan penggabungan data dari kedua table (union)
        $query = $barangMasukData->union($barangKeluarData);
        //sorting dari data terbaru ke paling lama
        $masukkeluar = $query->orderBy('tanggal', 'DESC')->get();
        return response()->view('dashboard', compact('barang','kategori','masukkeluar','barangmasuk', 'barangkeluar','dateFilter'));
    }
}
