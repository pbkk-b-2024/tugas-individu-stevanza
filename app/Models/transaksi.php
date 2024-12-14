<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['pelanggan_id', 'booking_id', 'mekanik_id', 'total_harga', 'status_pembayaran', 'order_id'];
    
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function mekanik()
    {
        return $this->belongsTo(Mekanik::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}