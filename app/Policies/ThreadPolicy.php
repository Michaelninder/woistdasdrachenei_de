<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Enums\UserRole;

class ThreadPolicy
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
        return true; // Everyone can view threads
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Thread $thread): bool
    {
        return true; // Everyone can view a specific thread
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Any logged-in user can create a thread
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Thread $thread): bool
    {
        return $user->id === $thread->user_id; // Only the owner can update their thread
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Thread $thread): bool
    {
        return $user->id === $thread->user_id; // Only the owner can soft delete their thread
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Thread $thread): bool
    {
        return $user->id === $thread->user_id; // Only the owner can restore their thread
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Thread $thread): bool
    {
        return $user->role === UserRole::Admin; // Only Admin can permanently delete
    }
}
