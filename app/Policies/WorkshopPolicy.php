<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workshop;
use Illuminate\Auth\Access\Response;

class WorkshopPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Workshop $workshop): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->isCoach()
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Workshop $workshop): Response
    {
        return $user->isCoach()
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Workshop $workshop): Response
    {
        return $user->isCoach() || $user->isAdmin()
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Workshop $workshop): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Workshop $workshop): bool
    {
        return false;
    }
}
