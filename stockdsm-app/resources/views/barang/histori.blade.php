@extends('layout.layout')
@section('title', 'Barang')
@section('content')

<div class="title">Histori Barang</div>
<br>
<a href="{{route('barang.index')}}">
    <div class="kembali">
        Kembali ke halaman Barang
    </div>
</a>
<br><br><br>
<table id="isiTabel">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Total Barang Masuk</th>
            <th>Total Barang Keluar</th>
            <th>Stok Sekarang</th>
            <th>Detail Stok</th>
            <th>Edit</th>
            <th>Aktif</th>
        </tr>
    </thead>
    <tbody>
        @foreach($barang as $key => $value)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$value->id_barangs}}</td>
                <td>{{$value->nama_barang}}</td>
                <td>{{$value->kategori->nama_kategori}}</td>
                <td>{{$value->total_masuk}}</td>
                <td>{{$value->total_keluar}}</td>
                <td>{{number_format($value->total_masuk-$value->total_keluar, 0 ,',', '.')}}</td>
                <td><a href="{{route('barang.show', ['id' => $value->id])}}">
                    <div class="detail">
                        Detail
                    </div>
                </a></td>
                <td><a href="{{route('barang.edit', ['id' => $value->id])}}">
                    <div class="edit">
                        Edit
                    </div>
                </a></td>
                <td>
                    <div class="hapus" onclick="modal_aktif('barang',{{$value->id}}, '{{route('barang.aktif', ['id'=> $value->id])}}')" style="cursor:pointer">
                        Aktif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection