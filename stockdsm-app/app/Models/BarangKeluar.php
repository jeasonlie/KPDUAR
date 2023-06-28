<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'barangkeluar';

    public function User() {
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function BarangKeluarDetail() {
        return $this->hasMany(BarangKeluarDetail::class,'id_barangkeluar','id');
    }
}
