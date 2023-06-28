<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barangmasuk';

    public function User() {
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function BarangMasukDetail() {
        return $this->hasMany(BarangMasukDetail::class,'id_barangmasuk','id');
    }
}
