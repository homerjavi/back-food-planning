<?php

namespace App\Policies;

use App\Models\MealType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MealTypePolicy
{
    use HandlesAuthorization;

    public function update(User $user, MealType $mealtype)
    {
        return $user->account_id === $mealtype->account_id ?: $this->deny('Esta tipología no pertenece a su cuenta');
    }

    public function delete(User $user, MealType $mealtype)
    {
        return $user->account_id === $mealtype->account_id ?: $this->deny('Esta tipología no pertenece a su cuenta');
    }
}
