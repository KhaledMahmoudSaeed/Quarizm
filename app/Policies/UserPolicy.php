<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }
    public function coaches(User $user): Response
    {
        return $user->isCoachee()
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): Response
    {
        return $user->isAdmin() || $user->id === $model->id
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): Response
    {
        return is_null($user)
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU ALREADY HAVE AN ACCOUNT");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): Response
    {
        return $user->isAdmin() || $user->id === $model->id
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response
    {
        return $user->id === $model->id || $user->isAdmin()
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
