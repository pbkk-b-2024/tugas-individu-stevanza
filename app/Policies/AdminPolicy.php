<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can access admin features.
     */
    public function viewAdmin(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can access admin dashboard.
     */
    public function accessDashboard(User $user): bool
    {
        return $user->role === 'admin';
    }
}