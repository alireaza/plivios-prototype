<?php

namespace App\Policies;

use App\Models\User;

class AuthenticationPolicy
{
    public function create(?User $user): bool
    {
        return is_null($user);
    }

    public function store(?User $user): bool
    {
        return is_null($user);
    }

    public function destroy(?User $user): bool
    {
        return !is_null($user);
    }
}
