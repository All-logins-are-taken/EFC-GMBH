<?php

namespace App\Services;

use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Response;
use Inertia\ResponseFactory;

class AuthorizationService
{
    public function isUserAuthorized($method): bool|Response|ResponseFactory
    {
        $user = Auth::user();

        if ($user !== null && $user->can($method, Advertisement::class)) {
            return true;
        }

        Session::flash('Not Authorized.');

        return inertia('Advertisement/List');
    }
}
