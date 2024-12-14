<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'produk_id',
        'quantity',
        'total_price',
        'address',
        'payment_method',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
    }

    const STATUS_PENDING = 'pending';
    const STATUS_DIPROSES = 'diproses';
    const STATUS_DIANTAR = 'diantar';
    const STATUS_SELESAI = 'selesai';
    const STATUS_DIBATALKAN = 'dibatalkan';

    const PAYMENT_TRANSFER = 'transfer';
    const PAYMENT_COD = 'cod';
    const PAYMENT_EWALLET = 'ewallet';

    public static function getStatusOptions()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_DIPROSES => 'Diproses',
            self::STATUS_DIANTAR => 'Diantar',
            self::STATUS_SELESAI => 'Selesai',
            self::STATUS_DIBATALKAN => 'Dibatalkan',
        ];
    }

    public static function getPaymentMethodOptions()
    {
        return [
            self::PAYMENT_TRANSFER => 'Transfer Bank',
            self::PAYMENT_COD => 'Cash on Delivery',
            self::PAYMENT_EWALLET => 'E-Wallet',
        ];
    }

    public function getStatusLabelAttribute()
    {
        return self::getStatusOptions()[$this->status] ?? $this->status;
    }

    public function getPaymentMethodLabelAttribute()
    {
        return self::getPaymentMethodOptions()[$this->payment_method] ?? $this->payment_method;
    }
}