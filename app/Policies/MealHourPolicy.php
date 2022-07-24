<?php

namespace App\Policies;

use App\Models\MealHour;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MealHourPolicy
{
    use HandlesAuthorization;

    public function update(User $user, MealHour $mealHour)
    {
        return $user->account_id === $mealHour->account_id ?: $this->deny('Este horario no ertenece a su cuenta');
    }

    public function delete(User $user, MealHour $mealHour)
    {
        return $user->account_id === $mealHour->account_id ?: $this->deny('Este horario no pertenece a su cuenta');
    }
}
