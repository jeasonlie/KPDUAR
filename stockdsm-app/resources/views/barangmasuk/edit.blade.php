@extends('layout.layout')
@section('title', 'Edit Barang Masuk')
@section('content')

<div class="title">Edit Barang Masuk</div>
<br>
<form action="{{ route('barangmasuk.update', ['id' => $barangmasuk->id]) }}" method="post">
    @csrf
    @method('patch')
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
                &emsp;:&emsp;<input type="date" name="tanggal_masuk" id="" value="{{$barangmasuk->tanggal}}">
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
            @foreach($barangmasuk->BarangMasukDetail as $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->barang->id_barangs}}</td>
                    <td>{{$value->barang->nama_barang}}</td>
                    <td>{{$value->barang->kategori->nama_kategori}}</td>
                    <td><input type="text" name="jumlah_barang[]" value="{{$value->jumlah_barang}}"></td>
                    <td>
                        <input type="text" name="keterangan_masuk[]" value="{{$value->keterangan_masuk}}">
                        <input type="hidden" name="id[]" value="{{$value->id}}">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
@endsection