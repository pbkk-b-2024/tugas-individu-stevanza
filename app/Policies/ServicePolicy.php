<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; 
    }

    public function manageBookings(User $user)
    {
        return $user->role === 'admin';
    }

    public function updateStatus(User $user)
    {
        return $user->role === 'admin';
    }
}