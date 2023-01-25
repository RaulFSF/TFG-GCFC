<?php

namespace App\Policies;

use App\Models\CategoryMatch;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryMatchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->role === 'president' || $user->role === 'admin' || $user->role === 'prompter';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoryMatch  $categoryMatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CategoryMatch $categoryMatch)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoryMatch  $categoryMatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, CategoryMatch $categoryMatch)
    {
        return $user->role === 'admin';

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoryMatch  $categoryMatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CategoryMatch $categoryMatch)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoryMatch  $categoryMatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CategoryMatch $categoryMatch)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoryMatch  $categoryMatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CategoryMatch $categoryMatch)
    {
        //
    }
}
