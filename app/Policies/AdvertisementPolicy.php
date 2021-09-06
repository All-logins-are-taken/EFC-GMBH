<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AdvertisementPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response|bool
    {
        return true;
    }

    public function view(User $user, Advertisement $advertisement): Response|bool
    {
        return true;
    }

    public function create(User $user): Response|bool
    {
        if ($user->exists) {
            return true;
        }
    }

    public function update(User $user, Advertisement $advertisement): Response|bool
    {
        if ($user->id === $advertisement->user_id) {
            return true;
        }
    }

    public function delete(User $user, Advertisement $advertisement): Response|bool
    {
        if ($user->id === $advertisement->user_id) {
            return true;
        }
    }

    public function restore(User $user, Advertisement $advertisement): Response|bool
    {
        if ($user->id === $advertisement->user_id) {
            return true;
        }
    }

    public function forceDelete(User $user, Advertisement $advertisement): Response|bool
    {
        if ($user->id === $advertisement->user_id) {
            return true;
        }
    }
}
