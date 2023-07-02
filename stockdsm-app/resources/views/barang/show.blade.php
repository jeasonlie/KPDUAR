@extends('layout.layout')
@section('title', 'Barang')
@section('content')
<div class="title">Detail Stok Barang</div>
<br>
<div class="kartu">
    <table>
        <tr>
            <td>
                ID Barang
            </td>
            <td>
            &emsp;:&emsp;{{$barang->id_barangs}}
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
            &emsp;:&emsp;{{ number_format($barang->total_masuk-$barang->total_keluar, 0 ,',', '.')}}
            </td>
        </tr>
    </table>
    <br>
    <div>*Total Stok didapat dari Total Barang Masuk - Total Barang keluar</div>
    <div>Total Stok =  {{ number_format($barang->total_masuk, 0 ,',', '.')}} - {{ number_format($barang->total_keluar, 0 ,',', '.')}}</div>
</div>
<br><br>
{{-- hapus flex-group kalo atas bawah --}}
<div class="table-group flex-group"> 
    <div>
        <div class="subheader"> Barang Masuk</div>
        <div> Total Keseluruhan: {{ number_format($barang->total_masuk, 0 ,',', '.')}} </div>
        <br>
        <table id="isiTabel">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>ID Barang Masuk</th>
                    <th>Jumlah Barang</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangmasuk as $key => $value)
                <tr class='clickable-row' data-href='{{route('barangmasuk.show', ['id' => $value->id_barangmasuk])}}'>
                        <td>{{++$key}}</td>
                        <td>{{$value->tanggal}}</td>
                        <td>{{$value->id_barang_masuk}}</td>
                        <td>{{ number_format($value->jumlah_barang, 0 ,',', '.')}}</td>
                        <td>{{$value->keterangan_masuk}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        <div class="subheader">Barang Keluar</div>
        <div> Total Keseluruhan: {{ number_format($barang->total_keluar, 0 ,',', '.')}} </div>
        <br>
        <table id="isiTabel2">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>ID Barang Keluar</th>
                    <th>Jumlah Barang</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangkeluar as $key => $value)
                    <tr class='clickable-row' data-href='{{route('barangkeluar.show', ['id' => $value->id_barangkeluar])}}'>
                        <td>{{++$key}}</td>
                        <td>{{$value->tanggal}}</td>
                        <td>{{$value->id_barang_keluar}}</td>
                        <td>{{ number_format($value->jumlah_barang, 0 ,',', '.')}}</td>
                        <td>{{$value->keterangan_keluar}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
@endsection