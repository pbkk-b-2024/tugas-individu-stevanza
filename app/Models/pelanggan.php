<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama', 'alamat', 'nomor_telepon'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function motors()
    {
        return $this->hasMany(Motor::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'pelanggan_produk')->withPivot('jumlah');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }    
}