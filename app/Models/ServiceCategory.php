<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga_mulai',
        'icon'
    ];

    public function services()
    {
        return $this->hasMany(Servis::class, 'category_id');
    }
}