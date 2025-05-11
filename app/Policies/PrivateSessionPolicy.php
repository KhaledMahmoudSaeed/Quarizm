<?php

namespace App\Policies;

use App\Models\PrivateSession;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PrivateSessionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        $privateSession = PrivateSession::latest()->first();

        if (!$privateSession) {
            return Response::denyWithStatus(404, "Session not found");
        }

        $coachId = $privateSession->coach_id;
        $coacheeId = $privateSession->coachee_id;
        return $user->id === $coachId || $user->id === $coacheeId
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PrivateSession $privateSession): Response
    {
        $coachId = PrivateSession::getAttribute('coach_id');
        $coacheeId = PrivateSession::getAttribute('coachee_id');
        return $user->id === $coachId || $user->id === $coacheeId
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->isCoachee()
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PrivateSession $privateSession): Response
    {
        return $user->isCoach()
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PrivateSession $privateSession): Response
    {
        return $user->isCoach()
            ? Response::allow()
            : Response::denyWithStatus(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PrivateSession $privateSession): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PrivateSession $privateSession): bool
    {
        return false;
    }
}
