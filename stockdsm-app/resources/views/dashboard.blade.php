@extends('layout.layout')
@section('content')

<div class="judul-content">
    <div class="intro">Dashboard</div>
    <div class="sub-intro">Selamat datang, User</div>
</div>

<div class="isi-content">
    <div class="content-jumlah">
        <a href="/barang">
            <div>
                Total Barang
            </div>
            <div class="jumlah">
                
            </div>
        </a>
    </div>
    <div class="content-masuk">
        <a href="/barangmasuk">
            <div>
                Barang Masuk
            </div>
            <div class="jumlah">
                
            </div>
        </a>
    </div>
    <div class="content-keluar">
    <a href="/barangkeluar">
            <div>
                Barang Keluar
            </div>
            <div class="jumlah">
                
            </div>
        </a>
    </div>
</div>
@endsection
