@extends('layout.layout')
@section('title', 'Edit Barang')
@section('content')

<div class="title">Edit Barang</div>
<br>
<div class="input">
    <form action="{{ route('barang.update', ['id' => $barang->id]) }}" method="post">
        @csrf
        @method('patch')
        <div class="namabarang">
            <label for="">Nama Barang</label>
            <input type="text" name="nama_barang" value="{{$barang->nama_barang}}">
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
        <button type="submit">Simpan</button>
    </form>
</div>
@endsection