@extends('layout.layout')
@section('title', 'Barang')
@section('content')

<div class="title">Barang</div>
<br>
<div class="input">
    <form action="{{ route('barang.store') }}" method="post">
        @csrf
        <div class="namabarang">
            <label for="">Nama Barang</label>
            <input type="text" name="nama_barang" required>
        </div>
        <div class="kategori">
            <label for="">Kategori</label>
            <select name="id_kategori" id="">
                @foreach($kategori as $value)
                <option value="{{$value->id}}">{{$value->nama_kategori}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit">Tambah</button>
    </form>
</div>
<br><br><br>
<table id="isiTabel">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Barang Masuk</th>
            <th>Barang Keluar</th>
            <th>Total Stok</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>
    </thead>
    <tbody>
        @foreach($barang as $value)
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->nama_barang}}</td>
                <td>{{$value->kategori->nama_kategori}}</td>
                <td>{{$value->total_masuk}}</td>
                <td>{{$value->total_keluar}}</td>
                <td>{{$value->total_masuk-$value->total_keluar}}</td>
                <td><a href="{{route('barang.edit', ['id' => $value->id]) }}">
                    <div class="edit">
                        Edit
                    </div>
                </a></td>
                <td>
                    <form action="{{ route('barang.destroy', ['id' => $value->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection