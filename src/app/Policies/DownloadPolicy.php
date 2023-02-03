<?php

namespace App\Policies;

use App\Models\User;

class DownloadPolicy
{
    public function index(?User $user): bool
    {
        return !is_null($user);
    }

    public function create(?User $user): bool
    {
        return !is_null($user);
    }

    public function store(?User $user): bool
    {
        return !is_null($user);
    }

    public function edit(?User $user): bool
    {
        return !is_null($user);
    }

    public function update(?User $user): bool
    {
        return !is_null($user);
    }

    public function delete(?User $user): bool
    {
        return !is_null($user);
    }

    public function destroy(?User $user): bool
    {
        return !is_null($user);
    }
}
