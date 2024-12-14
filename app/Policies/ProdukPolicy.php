<?php

namespace App\Policies;

use App\Models\Produk;
use App\Models\User;

class ProdukPolicy
{
    // Mengizinkan semua pengguna untuk melihat daftar produk
    public function viewAny(User $user)
    {
        return true; // Semua pengguna dapat melihat
    }

    public function create(User $user)
    {
        return $user->isAdmin(); // Hanya admin yang bisa membuat produk
    }

    public function update(User $user, Produk $produk)
    {
        return $user->isAdmin(); // Hanya admin yang bisa memperbarui produk
    }

    public function delete(User $user, Produk $produk)
    {
        return $user->isAdmin(); // Hanya admin yang bisa menghapus produk
    }

    // Mengizinkan semua pengguna untuk melihat produk spesifik
    public function view(User $user, Produk $produk)
    {
        return true;
    }
}
