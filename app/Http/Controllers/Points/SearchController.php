<?php

namespace Grocelivery\Geolocalizer\Http\Controllers\Points;

use Grocelivery\Geolocalizer\Http\Controllers\Controller;
use Grocelivery\Geolocalizer\Http\Requests\Points\GetPoints;
use Grocelivery\Geolocalizer\Http\Requests\Points\GetPointsInCountry;
use Grocelivery\Geolocalizer\Http\Requests\Points\SearchPointsByName;
use Grocelivery\Geolocalizer\Http\Requests\Points\SearchPointsInRange;
use Grocelivery\Geolocalizer\Http\Resources\PointResource;
use Grocelivery\Geolocalizer\Models\Point;
use Grocelivery\Utils\Interfaces\JsonResponseInterface as JsonResponse;
use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class SearchController
 * @package Grocelivery\Geolocalizer\Http\Controllers\Points
 */
class SearchController extends Controller
{
    /**
     * @param GetPoints $request
     * @return JsonResponse
     */
    public function getPoints(GetPoints $request): JsonResponse
    {
        $query = Point::where('type', $request->attributes->get('type'));

        if ($request->has('select')) {
            $query->whereIn('_id', $request->input('select'));
        }

        if ($request->has('limit')) {
            $query->limit((int)$request->input('limit'));
        }

        $points = $query->get();

        return $this->response->withResource('points', new PointResource($points));
    }

    /**
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function getPoint(FormRequest $request): JsonResponse
    {
        $point = Point::where('_id', $request->attributes->get('id'))->firstOrFail();

        return $this->response->withResource('point', new PointResource($point));
    }

    /**
     * @param GetPointsInCountry $request
     * @return JsonResponse
     */
    public function getPointsInCountry(GetPointsInCountry $request): JsonResponse
    {
        $points = Point::where('payload.address.country_code', $request->input('country'))->get();

        return $this->response->withResource('points', new PointResource($points));
    }

    /**
     * @param SearchPointsInRange $request
     * @return JsonResponse
     */
    public function searchPointsInRange(SearchPointsInRange $request): JsonResponse
    {
        $points = Point::where('type', $request->attributes->get('type'));

        $points->whereNear(
            (float)$request->input('longitude'),
            (float)$request->input('latitude'),
            $request->input('kilometers')
        );

        return $this->response->withResource('results', new PointResource($points->get()));
    }

    /**
     * @param SearchPointsByName $request
     * @return JsonResponse
     */
    public function searchPointsByName(SearchPointsByName $request): JsonResponse
    {
        $points = Point::where('type', $request->attributes->get('type'));

        $points->whereFullText($request->input('name'));

        return $this->response->withResource('results', new PointResource($points->get()));
    }
}