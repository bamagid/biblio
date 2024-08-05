<?php

namespace App\Policies;

use App\Models\Livre;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LivrePolicy
{
    public function viewAny(User $user): Response
    {
        return $user->role === 'admin' ?
            Response::allow() :
            Response::deny('Vous ne pouvez pas voir les livres qui sont dans la corbeille.');
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role === 'admin' || $user->role === 'personnel' ?
            Response::allow() :
            Response::deny('Vous n\'avez pas les droits pour créer un livre.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Livre $livre): Response
    {
        return $user->role === 'admin' || $user->role == "personnel" ?
            Response::allow() :
            Response::deny('Vous n\'avez pas les droits pour modifier ce livre.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Livre $livre): Response
    {
        return $user->role === 'admin' || $user->role === "personnel" ?
            Response::allow() :
            Response::deny('Vous n\'avez pas les droits pour supprimer ce livre.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Livre $livre): Response
    {
        return $user->role === 'admin' ?
            Response::allow() :
            Response::deny('Vous n\'avez pas les droits pour restaurer ce livre.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Livre $livre): Response
    {
        return $user->role === 'admin' ?
            Response::allow() :
            Response::deny('Vous n\'avez pas les droits pour supprimer définitivement ce livre.');
    }
}
