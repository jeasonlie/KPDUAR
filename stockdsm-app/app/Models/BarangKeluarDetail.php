<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarDetail extends Model
{
    use HasFactory;
    protected $table = 'barangkeluardetail';

    public function BarangKeluar() {
        return $this->belongsTo(BarangKeluar::class, 'id_barang', 'id');
    }
}
