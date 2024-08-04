<?php

namespace App\Policies;

use App\Models\Livre;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LivrePolicy
{

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role == "admin" || $user->role == "personnel" ?
            Response::allow() :
            Response::deny("Vous n'avez pas les permissions pour ajouter un livre");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Livre $livre): Response
    {
        return $user->role == "admin" || $user->role == "personnel" ?
            Response::allow() :
            Response::deny("Vous n'avez pas les permissions pour modifier un livre");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Livre $livre): Response
    {
        return $user->role == "admin" || $user->role == "personnel" ?
            Response::allow() :
            Response::deny("Vous n'avez pas les permissions pour supprimé un livre");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Livre $livre): Response
    {
        return $user->role == "admin" && $livre ?
            Response::allow() :
            Response::deny("Vous n'avez pas les permissions pour restorer un livre");
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Livre $livre): Response
    {
        return $user->role == "admin" ?
            Response::allow() :
            Response::deny("Vous n'avez pas les permissions pour Supprimer un livre definitivement");
    }
}
