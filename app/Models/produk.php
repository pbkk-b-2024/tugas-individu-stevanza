<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi', 'harga', 'stok', 'gambar'];

    public function pelanggans()
    {
        return $this->belongsToMany(Pelanggan::class, 'pelanggan_produk')->withPivot('jumlah');
    }
}
