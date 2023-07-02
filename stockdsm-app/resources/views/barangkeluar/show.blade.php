@extends('layout.layout')
@section('title', 'Detail Barang Keluar')
@section('content')

<div class="title">Detail Barang Keluar</div>
<br>
<div class="kartu">
    <table>
        <tr>
            <td>
                ID Keluar
            </td>
            <td>
            &emsp;:&emsp;{{$barangkeluar->id_barang_keluar}}
            </td>
        </tr>
        <tr>
            <td>
                Tanggal Keluar
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
<br>
<button class="print" onclick="print()">Print</button>
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
                <td>{{$value->barang->id_barangs}}</td>
                <td>{{$value->barang->nama_barang}}</td>
                <td>{{$value->barang->kategori->nama_kategori}}</td>
                <td>{{number_format($value->jumlah_barang, 0 ,',', '.')}}</td>
                <td>{{$value->keterangan_keluar}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    function print() {
        const newWindow = window.open("{{route('barangkeluar.print', ['id' => $barangkeluar->id])}}");
    }
</script>
@endsection