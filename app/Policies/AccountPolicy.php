<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Account $account)
    {
        return $user->account_id === $account->id ?: $this->deny('Esta categoría no pertenece a su cuenta');
    }

    public function delete(User $user, Account $account)
    {
        return $user->account_id === $account->id ?: $this->deny('Esta categoría no pertenece a su cuenta');
    }
}
