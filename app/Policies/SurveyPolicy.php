<?php

namespace App\Policies;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SurveyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Survey $survey): bool
    {
        return session('organization_id') === $survey->organization_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, int $organizationId): bool
    {
        return session('organization_id') !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Survey $survey): bool
    {
        return
            $survey->user_id === $user->id ||
            session('organization_id') === $survey->organization_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Survey $survey): bool
    {
        return $survey->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Survey $survey): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Survey $survey): bool
    {
        return false;
    }

    public function answer(?User $user, Survey $survey): bool
    {
        if ($survey->is_anonymous) {
            return true; // tout le monde
        }

        if (!$user) {
            return false; // login nécessaire
        }

        return session('organization_id') === $survey->organization_id;
    }
}
