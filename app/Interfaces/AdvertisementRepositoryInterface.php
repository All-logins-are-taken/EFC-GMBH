<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface AdvertisementRepositoryInterface
{
    public function all(Request $request): LengthAwarePaginator;

    public function getById($id): mixed;
}
