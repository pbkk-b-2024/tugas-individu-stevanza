<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';
    protected $fillable = ['pelanggan_id', 'transaksi_id', 'komentar', 'rating'];

    // Allow null values for transaksi_id
    protected $attributes = [
        'transaksi_id' => null,
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}