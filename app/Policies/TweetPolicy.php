<?php

namespace App\Policies;

use App\Models\Tweet;
use App\Models\User;

class TweetPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tweet $tweet): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tweet $tweet): bool
    {
        return $tweet->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tweet $tweet): bool
    {
        return $tweet->user_id === $user->id || $user->email === 'account@louisweigel.com';
    }
}
