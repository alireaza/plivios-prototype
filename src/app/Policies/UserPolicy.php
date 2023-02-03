<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function create(?User $user): bool
    {
        return is_null($user);
    }

    public function store(?User $user): bool
    {
        return is_null($user);
    }

    public function show(?User $user): bool
    {
        return !is_null($user);
    }
}
