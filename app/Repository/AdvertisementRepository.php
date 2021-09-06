<?php

namespace App\Repository;

use App\Interfaces\AdvertisementRepositoryInterface;
use App\Models\Advertisement;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class AdvertisementRepository implements AdvertisementRepositoryInterface
{
    public function all(Request $request): LengthAwarePaginator
    {
        return Advertisement::with('images')
            ->orderBy($request->sort ?? 'title', $request->direction ?? 'asc')
            ->paginate(Advertisement::ADVERTISEMENT_PER_PAGE);
    }

    public function getById($id): mixed
    {
        return Advertisement::where('id', $id)->get();
    }
}
