<?php

namespace App\Policies;

use App\Models\ThreadMessage;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Enums\UserRole;

class ThreadMessagePolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->role === UserRole::Admin || $user->role === UserRole::Moderator) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Everyone can view messages
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ThreadMessage $threadMessage): bool
    {
        return true; // Everyone can view a specific message
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Any logged-in user can create a message
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ThreadMessage $threadMessage): bool
    {
        return $user->id === $threadMessage->user_id; // Only the owner can update their message
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ThreadMessage $threadMessage): bool
    {
        return $user->id === $threadMessage->user_id; // Only the owner can soft delete their message
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ThreadMessage $threadMessage): bool
    {
        return $user->id === $threadMessage->user_id; // Only the owner can restore their message
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ThreadMessage $threadMessage): bool
    {
        return $user->role === UserRole::Admin; // Only Admin can permanently delete
    }
}
