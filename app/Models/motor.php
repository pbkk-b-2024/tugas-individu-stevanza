<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'pelanggan_id', 'merk', 'model', 'tahun', 'nomor_plat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}