@extends('layout.layout')
@section('title', 'Barang')
@section('content')

<div class="title">Detail Stok</div>
<br>
<div class="kartu">
    <table>
        <tr>
            <td>
                ID
            </td>
            <td>
            &emsp;:&emsp;{{$barang->id}}
            </td>
        </tr>
        <tr>
            <td>
                Nama Barang
            </td>
            <td>
            &emsp;:&emsp;{{$barang->nama_barang}}
            </td>
        </tr>
        <tr>
            <td>
                Total Stok
            </td>
            <td >
            &emsp;:&emsp;{{$barang->total_masuk-$barang->total_keluar}}
            </td>
        </tr>
    </table>
</div>
<br><br><br>
<table id="isiTabel2">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($barangmasuk as $value)
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->id_barang}}</td>
                <td>{{$value->nama_barang}}</td>
                <td>{{$value->jumlah_barang}}</td>
                <td>{{$value->keterangan_masuk}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<table id="isiTabel">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($barangkeluar as $value)
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->id_barang}}</td>
                <td>{{$value->nama_barang}}</td>
                <td>{{$value->jumlah_barang}}</td>
                <td>{{$value->keterangan_keluar}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection