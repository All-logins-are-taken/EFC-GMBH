<?php

namespace App\Services;

class QueryDataService
{
    public function requestData($request): array
    {
        $page = '1';
        $sort = 'title';
        $direction = 'asc';

        if ($request->getSession() !== null && !empty($request->getSession()->get('_previous')['url'])) {

            if(str_contains($request->getSession()->get('_previous')['url'], 'page')) {
                $firstPageSplit = explode('page=', $request->getSession()->get('_previous')['url']);
                $secondPageSplit = explode('&', $firstPageSplit[1]);
                $page = $secondPageSplit[0];
            }

            if(str_contains($request->getSession()->get('_previous')['url'], 'sort')) {
                $firstSortSplit = explode('sort=', $request->getSession()->get('_previous')['url']);
                $secondSortSplit = explode('&', $firstSortSplit[1]);
                $sort = $secondSortSplit[0];
            }

            if(str_contains($request->getSession()->get('_previous')['url'], 'direction')) {
                $firstDirectionSplit = explode('sort=', $request->getSession()->get('_previous')['url']);
                $secondDirectionSplit = explode('&', $firstDirectionSplit[1]);
                $direction = $secondDirectionSplit[0];
            }
        }

        return ['page' => $page, 'sort' => $sort, 'direction' => $direction];
    }
}
