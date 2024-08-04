<?php

namespace App\Policies;

use App\Models\Emprunt;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EmpruntPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role == "membre" ?
            Response::allow() :
            Response::deny("Vous n'êtes pas autorisé a faire d'emprunt");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Emprunt $emprunt)
    {
        return  $user->role == "admin" || $user->role == "personnel" ?
            Response::allow() :
            Response::deny("Vous n'etes pas autorisé a rendre le livre");
    }
}
