<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'pelanggan_id',
        'motor_id',
        'mekanik_id',
        'keluhan',
        'tanggal_booking',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }

    public function mekanik()
    {
        return $this->belongsTo(Mekanik::class, 'mekanik_id');
    }

    public function servis()
    {
        return $this->hasOne(Servis::class, 'booking_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}