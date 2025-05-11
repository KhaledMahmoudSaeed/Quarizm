<?php

namespace App\Policies;

use App\Models\CoachDate;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoachDatePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, CoachDate $coachDate): Response
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
    public function update(User $user, CoachDate $coachDate): Response
    {
        return $user->isCoach()
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CoachDate $coachDate): Response
    {
        return $user->isCoach()
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CoachDate $coachDate): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CoachDate $coachDate): bool
    {
        return false;
    }
}
