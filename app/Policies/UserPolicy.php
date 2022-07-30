<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $userRequest)
    {
        return $user->id === $userRequest->id && $user->account_id == request()->account_id ?: $this->deny('No tiene permisos para actualizar este usuario');
    }

    public function delete(User $user)
    {
        return $user->id === request()->user()->id && $user->account_id == request()->account_id ?: $this->deny('No tiene permisos para eliminar este usuario');
    }
}
