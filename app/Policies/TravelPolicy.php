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
        return $user->role === Role::admin();
    }

    public function view(User $user, Travel $travel): bool
    {

        if (! $travel->isPublic() && $user->role === Role::admin()) {
            return true;
        }

    }

    public function create(User $user): bool
    {
        return $user->role === Role::admin();
    }

    public function update(User $user, Travel $travel): bool
    {
        return $user->role === Role::editor();
    }

    public function delete(User $user, Travel $travel): bool
    {
        return $user->role === Role::admin();
    }

    public function restore(User $user, Travel $travel): bool
    {
        return $user->role === Role::admin();
    }

    public function forceDelete(User $user, Travel $travel): bool
    {
        return $user->role === Role::admin();
    }
}
