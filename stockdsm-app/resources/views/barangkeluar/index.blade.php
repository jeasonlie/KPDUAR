@extends('layout.layout')
@section('title', 'Barang Keluar')
@section('content')

<div class="title">Barang Keluar</div>
<br>
<div class="input">
    <form action="{{route('barangkeluar.index')}}" method="POST">
        @csrf
        <div class="namabarang">
            <label for="">Nama Barang</label>
            <select name="id_barang" id="">
                @foreach ($barang as $value)
                <option value="{{$value->id}}">{{$value->nama_barang}}</option>
                @endforeach
            </select>
        </div>
        <div class="jumlahbarang">
            <label for="">Jumlah Barang</label>
            <input type="text" name="jumlah_barang" required>
        </div>
        <div class="keterangan">
            <label for="">Keterangan</label>
            <input type="text" name="keterangan_keluar">
        </div>
        <div class="tanggalkeluar">
            <label for="">Tanggal Keluar</label>
            <input type="date" name="tanggal_keluar" id="">
        </div>
    </form>
</div>
@endsection