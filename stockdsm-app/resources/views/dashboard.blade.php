@extends('layout.layout')
@section('title', 'Dashboard')
@section('content')

<div class="judul-content">
    <div class="intro">Dashboard</div>
    <div class="sub-intro">Selamat datang, {{Auth::user()->name}}</div>
</div>

<div class="isi-content">
    <div class="content-jumlah">
        <a href="{{route('barang.index')}}">
            <div>
                Total Barang
            </div>
            <div class="jumlah">
                {{count($barang)}}
            </div>
        </a>
    </div>
    <div class="content-masuk">
        <a href="{{route('barangmasuk.index')}}">
            <div>
                Barang Masuk
            </div>
            <div class="jumlah">
                {{count($barangmasuk)}}
            </div>
        </a>
    </div>
    <div class="content-keluar">
        <a href="{{route('barangkeluar.index')}}">
            <div>
                Barang Keluar
            </div>
            <div class="jumlah">
                {{count($barangkeluar)}}
            </div>
        </a>
    </div>
</div>
<div class="grid-filter" style="margin-top: 20px">
    <h5 style="font-size:12px;margin-top:5px;margin-right:8px">Filter Tanggal</h5>
    <form method="get" action="dashboard">
        <div class="input-group" style="display: flex; gap:10px">
            <div>
            <select class="form-select select2" name="date_filter">
                <option value="">Semua</option>
                <option value="today" {{ $dateFilter == 'today' ? 'selected' : '' }}>Hari ini</option>
                <option value="yesterday" {{ $dateFilter == 'yesterday' ? 'selected' : '' }}>Kemarin</option>
                <option value="this_week" {{ $dateFilter == 'this_week' ? 'selected' : '' }}>Minggu ini</option>
                <option value="last_week" {{ $dateFilter == 'last_week' ? 'selected' : '' }}>Minggu lalu</option>
                <option value="this_month" {{ $dateFilter == 'this_month' ? 'selected' : '' }}>Bulan ini</option>
                <option value="last_month" {{ $dateFilter == 'last_month' ? 'selected' : '' }}>Bulan lalu</option>
                <option value="this_year" {{ $dateFilter == 'this_year' ? 'selected' : '' }}>Tahun ini</option>
                <option value="last_year" {{ $dateFilter == 'last_year' ? 'selected' : '' }}>Tahun lalu</option>
            </select>
            </div>
        
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>
</div>
<table id="isiTabel">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Total Barang</th>
            <th>Diinput Oleh</th>
            <th>Keterangan</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($masukkeluar as $key => $value)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$value->tanggal}}</td>
                <td>{{$value->total_barang}}</td>
                <td>{{$value->user->name}}</td>
                <td>{{$value->keterangan}}</td>
                @if ($value->keterangan == "Masuk")
                    <td><a href="{{route('barangmasuk.show', ["id" => $value->id])}}">Detail</a></td>
                @else
                    <td><a href="{{route('barangkeluar.show', ["id" => $value->id])}}">Detail</a></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
