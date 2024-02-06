<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\Travel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TravelPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role->id === Role::admin()->id;
    }

    public function view(User $user, Travel $travel): bool
    {
        return ! $travel->isPublic() && $user->role->id === Role::admin()->id;
    }

    public function create(User $user): bool
    {
        return $user->role->id === Role::admin()->id;
    }

    public function update(User $user, Travel $travel): bool
    {
        return $user->role->id === Role::editor()->id;
    }

    public function delete(User $user, Travel $travel): bool
    {
        return $user->role->id === Role::admin()->id;
    }

    public function restore(User $user, Travel $travel): bool
    {
        return $user->role->id === Role::admin()->id;
    }

    public function forceDelete(User $user, Travel $travel): bool
    {
        return $user->role->id === Role::admin()->id;
    }
}
