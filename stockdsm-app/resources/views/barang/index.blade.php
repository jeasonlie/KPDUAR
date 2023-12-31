@extends('layout.layout')
@section('title', 'Barang')
@section('content')

<div class="title">Barang</div>
<br>
<div class="input" style="position:relative">
    <form action="{{ route('barang.store') }}" method="post">
        @csrf
        <table class="tabel-form">
            <tr>
                <td>
                <label for="">Nama Barang</label>
                </td>
                <td>
                <input type="text" name="nama_barang" required>
                </td>
            </tr>
            <tr>
                <td>
                <label for="">Kategori</label>
                </td>
                <td>
                    <select name="id_kategori" id="">
                    @foreach($kategori as $value)
                    <option value="{{$value->id}}">{{$value->nama_kategori}}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
        </table>
        <br>
        <button type="submit">Tambah</button>
        <a href="{{route('barang.histori')}}">
            <div class="histori" style="margin-top:10px; position:absolute; top:0px; right:105px ">
                Histori Barang
            </div>
        </a>
    </form>
</div>
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
            <th>Nonaktif</th>
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
                    <div class="hapus" onclick="modal_delete('barang',{{$value->id}}, '{{route('barang.destroy', ['id'=> $value->id])}}')" style="cursor:pointer">
                        Nonaktif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection