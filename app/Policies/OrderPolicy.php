<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // Semua user bisa melihat daftar pesanan mereka sendiri
    }

    public function view(User $user, Order $order)
    {
        return $user->id === $order->user_id || $user->isAdmin();
    }

    public function create(User $user)
    {
        return true; // Semua user bisa membuat pesanan
    }

    public function update(User $user, Order $order)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Order $order)
    {
        return $user->isAdmin();
    }

    public function confirmOrder(User $user, Order $order)
    {
        return $user->isAdmin() && $order->status === 'pending';
    }

    public function cancelOrder(User $user, Order $order)
    {
        return $user->isAdmin() && $order->status !== 'completed';
    }
}