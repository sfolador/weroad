<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TourPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Tour $tour): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role->id === Role::admin()->id;
    }

    public function update(User $user, Tour $tour): bool
    {
        return $user->role->id === Role::admin()->id;
    }

    public function delete(User $user, Tour $tour): bool
    {
        return $user->role->id === Role::admin()->id;
    }

    public function restore(User $user, Tour $tour): bool
    {
        return $user->role->id === Role::admin()->id;
    }

    public function forceDelete(User $user, Tour $tour): bool
    {
        return $user->role->id === Role::admin()->id;
    }
}
