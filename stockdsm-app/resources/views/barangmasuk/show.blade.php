@extends('layout.layout')
@section('title', 'Detail Barang Masuk')
@section('content')

<div class="title">Detail Barang Masuk</div>
<br>
<div class="kartu">
    <table>
        <tr>
            <td>
                ID
            </td>
            <td>
            &emsp;:&emsp;{{$barangmasuk->id}}
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
        @foreach($barangmasuk->BarangMasukDetail as $value)
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->id_barang}}</td>
                <td>{{$value->barang->nama_barang}}</td>
                <td>{{$value->barang->kategori->nama_kategori}}</td>
                <td>{{ number_format($value->jumlah_barang, 0 ,',', '.')}}</td>
                <td>{{$value->keterangan_masuk}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    function print() {
        const newWindow = window.open("{{route('barangmasuk.print', ['id' => $barangmasuk->id])}}");
    }
</script>
@endsection