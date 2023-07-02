@extends('layout.layout')
@section('title', 'Edit Barang Keluar')
@section('content')

<div class="title">Edit Barang Keluar</div>
<br>
<form action="{{ route('barangkeluar.update', ['id' => $barangkeluar->id]) }}" method="post">
    @csrf
    @method('patch')
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
                &emsp;:&emsp;<input type="date" name="tanggal_keluar" id="" value="{{$barangkeluar->tanggal}}">
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
            <tr>
                <td>
                    <button type="submit">Simpan</button>
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
                    <td>{{$value->barang->id_barangs}}</td>
                    <td>{{$value->barang->nama_barang}}</td>
                    <td>{{$value->barang->kategori->nama_kategori}}</td>
                    <td><input type="text" name="jumlah_barang[]" value="{{$value->jumlah_barang}}"></td>
                    <td>
                        <input type="text" name="keterangan_keluar[]" value="{{$value->keterangan_keluar}}">
                        <input type="hidden" name="id[]" value="{{$value->id}}">
                        <input type="hidden" name="id_barang[]" value="{{$value->id_barang}}">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
@endsection