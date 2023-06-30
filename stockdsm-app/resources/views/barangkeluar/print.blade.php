@extends('layout.print')
@section('title', 'Print Laporan Barang keluar')
@section('content')
<br>
    <div class="title">Detail Barang Keluar</div>
    <br>
    <div class="kartu">
        <table>
            <tr>
                <td>
                    ID
                </td>
                <td>
                &emsp;:&emsp;{{$barangkeluar->id}}
                </td>
            </tr>
            <tr>
                <td>
                    Tanggal keluar
                </td>
                <td>
                &emsp;:&emsp;{{$barangkeluar->tanggal}}
                </td>
            </tr>
            <tr>
                <td>
                    Diinput oleh
                </td>
                <td >
                &emsp;:&emsp;{{$barangkeluar->User->name}}
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
            @foreach($barangkeluar->BarangKeluarDetail as $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->id_barang}}</td>
                    <td>{{$value->barang->nama_barang}}</td>
                    <td>{{$value->barang->kategori->nama_kategori}}</td>
                    <td>{{$value->jumlah_barang}}</td>
                    <td>{{$value->keterangan_keluar}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection