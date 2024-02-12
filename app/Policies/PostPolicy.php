<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Policy for Post model actions.
 *
 * This policy determines the authorization logic for various actions
 * that can be performed on the Post model by a User.
 */
class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any instances of the model.
     *
     * @param  User  $user The current authenticated user.
     * @return bool True if the user can view any instances of the model, otherwise false.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model instance.
     *
     * @param  User  $user The current authenticated user.
     * @param  Post  $post The specific Post model instance.
     * @return bool True if the user can view the model instance, otherwise false.
     */
    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create instances of the model.
     *
     * @param  User  $user The current authenticated user.
     * @return bool True if the user can create instances of the model, otherwise false.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model instance.
     *
     * @param  User  $user The current authenticated user.
     * @param  Post  $post The specific Post model instance to update.
     * @return bool True if the user can update the model instance, otherwise false.
     */
    public function update(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model instance.
     *
     * @param  User  $user The current authenticated user.
     * @param  Post  $post The specific Post model instance to delete.
     * @return bool True if the user can delete the model instance, otherwise false.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the deleted model instance.
     *
     * @param  User  $user The current authenticated user.
     * @param  Post  $post The specific Post model instance to restore.
     * @return bool True if the user can restore the model instance, otherwise false.
     */
    public function restore(User $user, Post $post): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model instance.
     *
     * @param  User  $user The current authenticated user.
     * @param  Post  $post The specific Post model instance to force delete.
     * @return bool True if the user can permanently delete the model instance, otherwise false.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $user->role === 'admin';
    }
}
