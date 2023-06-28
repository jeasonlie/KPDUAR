<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';

    public function Kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
}
