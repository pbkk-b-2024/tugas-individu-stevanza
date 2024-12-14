<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mekanik extends Model
{
    use HasFactory;
    
    protected $table = 'mekanik'; // Menentukan nama tabel yang benar
    protected $fillable = ['nama', 'spesialisasi'];

    // Relasi ke bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'mekanik_id');
    }

    // Relasi ke servis
    public function servis()
    {
        return $this->hasMany(Servis::class, 'mekanik_id');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}