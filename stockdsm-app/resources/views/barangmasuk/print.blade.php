@extends('layout.print')
@section('title', 'Print Laporan Barang Masuk')
@section('content')
<br>
    <div class="title">Detail Barang Masuk</div>
    <br>
    <div class="kartu">
        <table>
            <tr>
                <td>
                    ID Masuk
                </td>
                <td>
                    &emsp;:&emsp;{{$barangmasuk->id_barang_masuk}}
                </td>
            </tr>
            <tr>
                <td>
                    Tanggal Masuk
                </td>
                <td>
                    &emsp;:&emsp;{{$barangmasuk->tanggal}}
                </td>
            </tr>
            <tr>
                <td>
                    Diinput oleh
                </td>
                <td >
                    &emsp;:&emsp;{{$barangmasuk->User->name}}
                </td>
            </tr>
        </table>
    </div>
    <br><br><br>
    <table id="isiTabel">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah Barang</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangmasuk->BarangMasukDetail as $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->barang->id_barangs}}</td>
                    <td>{{$value->barang->nama_barang}}</td>
                    <td>{{$value->barang->kategori->nama_kategori}}</td>
                    <td>{{$value->jumlah_barang}}</td>
                    <td>{{$value->keterangan_masuk}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection