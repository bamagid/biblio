<?php

namespace App\Policies;

use App\Models\Emprunt;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EmpruntPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->role === 'admin' || $user->role === 'personnel' ?
            Response::allow() :
            Response::deny('Vous ne pouvez pas voir les emprunts.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Emprunt $emprunt): Response
    {
        return $user->role === 'admin' || $user->role === 'personnel' || $emprunt->user_id === $user->id ?
            Response::allow() :
            Response::deny('Vous ne pouvez pas voir cet emprunt.');
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role === 'membre' ?
            Response::allow()
            : Response::deny('Vous ne pouvez pas effectuer un emprunt.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Emprunt $emprunt): Response
    {
        return $user->role == "admin" || $user->role == "personnel" ?
            Response::allow() :
            Response::deny('Vous ne pouvez pas modifier cet emprunt.');
    }
}
