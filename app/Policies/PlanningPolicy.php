<?php

namespace App\Policies;

use App\Models\Planning;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanningPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Planning $planning)
    {
        return $user->account_id === $planning->account_id ?: $this->deny('Esta categoría no pertenece a su cuenta');
    }

    public function delete(User $user, Planning $planning)
    {
        return $user->account_id === $planning->account_id ?: $this->deny('Esta categoría no pertenece a su cuenta');
    }
}
