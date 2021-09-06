<?php

namespace App\Policies;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertisementPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Advertisement $team): bool
    {
        return $user->belongsToTeam($team);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Advertisement $advertisement): bool
    {
        return $user->id === $advertisement->user->id;
    }

    public function destroy(User $user, Advertisement $advertisement): bool
    {
        return $user->id === $advertisement->user->id;
    }
}
