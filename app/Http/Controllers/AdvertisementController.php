<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Advertisement\CreateRequest;
use App\Http\Requests\Advertisement\DestroyRequest;
use App\Http\Requests\Advertisement\UpdateRequest;
use App\Models\Advertisement;
use App\Models\AdvertisementImage;
use App\Repository\AdvertisementRepository;
use App\Services\QueryDataService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Response;
use Inertia\ResponseFactory;

class AdvertisementController extends Controller
{
    public function index(Request $request, AdvertisementRepository $repository): Response|ResponseFactory
    {
        return inertia('Advertisement/List', ['advertisements' => $repository->all($request)]);
    }

    public function create(): Response
    {
        return inertia('Advertisement/Create');
    }

    public function store(CreateRequest $request): void
    {
        $advertisement = $request->user()->advertisements()->create(
            $request->validated()
        );

        AdvertisementImage::saveImages($request, $advertisement);

        Session::flash('message', 'Advertisement № ' . $advertisement->id . ' was created successfully');
    }

    public function show(Advertisement $advertisement): Response
    {
        return inertia('Advertisement/List', $advertisement);
    }

    public function edit(
        Request $request,
        QueryDataService $queryService,
        AdvertisementRepository $repository
    ): Response|ResponseFactory {
        $queryData = $queryService->requestData($request);

        $advertisement = $repository->getById($request->id);

        return inertia('Advertisement/Edit', ['advertisement' => $advertisement, 'queryData' => $queryData]);
    }

    public function update(UpdateRequest $request, AdvertisementRepository $repository): RedirectResponse
    {
        $validated = $request->validated();

        $advertisement = $repository->getById($request->id);
        $advertisement->update($validated);

        Session::flash('message', 'Advertisement № ' . $request->id . ' was edited');

        return redirect(
            'advertisement?page=' . $request->queryData['page'] . '&sort=' . $request->queryData['sort'] . '&direction=' . $request->queryData['direction']
        );
    }

    public function destroy(DestroyRequest $request, AdvertisementRepository $repository): RedirectResponse
    {
        $advertisement = $repository->getById($request->id);
        $advertisement->delete();

        Session::flash('message', 'Advertisement № ' . $request->advertisement . ' was deleted');

        return back();
    }
}
