<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    protected $fillable = [
        'motor_id', 
        'mekanik_id', 
        'pelanggan_id', 
        'booking_id',
        'service_category_id'
    ];

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }

    public function mekanik()
    {
        return $this->belongsTo(Mekanik::class, 'mekanik_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id')
                    ->with(['motor', 'pelanggan', 'user']);
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
}