<?php

namespace App\Policies;

use App\Models\Meal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MealPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Meal $meal)
    {
        return $user->account_id === $meal->category->account_id ?: $this->deny('Este plato no pertenece a su cuenta');
    }

    public function delete(User $user, Meal $meal)
    {
        return $user->account_id === $meal->category->account_id ?: $this->deny('Este plato no pertenece a su cuenta');
    }
}
