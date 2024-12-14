<?php

namespace App\Policies;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedbackPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Feedback $feedback)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Feedback $feedback)
    {
        return $user->id === $feedback->pelanggan->user_id;
    }

    public function delete(User $user, Feedback $feedback)
    {
        return $user->isAdmin() || $user->id === $feedback->pelanggan->user_id;
    }

    public function restore(User $user, Feedback $feedback)
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Feedback $feedback)
    {
        return $user->isAdmin();
    }
}