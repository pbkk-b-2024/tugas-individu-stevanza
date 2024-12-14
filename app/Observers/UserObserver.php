<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Pelanggan;

class UserObserver
{
    public function created(User $user)
    {
        Pelanggan::create([
            'nama' => $user->name,
            'user_id' => $user->id,
            // You might want to add default values for 'alamat' and 'nomor_telepon'
            'alamat' => '', // Default empty string
            'nomor_telepon' => '', // Default empty string
        ]);
    }
}