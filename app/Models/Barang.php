<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function masuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function keluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }
}
