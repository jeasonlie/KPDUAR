<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukDetail extends Model
{
    use HasFactory;
    protected $table = 'barangmasukdetail';

    public function BarangMasuk() {
        return $this->belongsTo(BarangMasuk::class, 'id_barang', 'id');
    }
}
