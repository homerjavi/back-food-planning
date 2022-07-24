<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Category $category)
    {
        return $user->account_id === $category->account_id ?: $this->deny('Esta categoría no pertenece a su cuenta');
    }

    public function delete(User $user, Category $category)
    {
        return $user->account_id === $category->account_id ?: $this->deny('Esta categoría no pertenece a su cuenta');
    }
}
