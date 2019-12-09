<?php

namespace Grocelivery\Geolocalizer\Http\Controllers\Points;

use Grocelivery\Geolocalizer\Http\Controllers\Controller;
use Grocelivery\Geolocalizer\Http\Requests\Points\CreatePoint;
use Grocelivery\Geolocalizer\Http\Requests\Points\ReplacePoints;
use Grocelivery\Geolocalizer\Http\Resources\PointResource;
use Grocelivery\Geolocalizer\Models\Point;
use Grocelivery\Utils\Interfaces\JsonResponseInterface as JsonResponse;
use Jenssegers\Mongodb\Collection;

/**
 * Class CreateController
 * @package Grocelivery\Geolocalizer\Http\Controllers\Points
 */
class CreateController extends Controller
{
    /**
     * @param CreatePoint $request
     * @return JsonResponse
     */
    public function createPoint(CreatePoint $request): JsonResponse
    {
        $point = new Point([
            'name' => $request->input('name'),
            'location' => [
                (float)$request->input('location.longitude'),
                (float)$request->input('location.latitude'),
            ],
            'payload' => $request->input('payload'),
            'type' => $request->attributes->get('type'),
        ]);

        $point->save();

        return $this->response
            ->setMessage('Point created successfully.')
            ->withResource('point', new PointResource($point));
    }

    /**
     * @param ReplacePoints $request
     * @return JsonResponse
     */
    public function replacePoints(ReplacePoints $request): JsonResponse
    {
        $type = $request->attributes->get('type');

        Point::where('type', $type)->delete();

        $points = $request->input('points');

        foreach ($points as &$point) {
            $point['type'] = $type;
        }

        Point::query()->raw(function (Collection $collection) use ($points): void {
            $collection->insertMany($points);
        });

        return $this->response
            ->setMessage('Collection replaced successfully.')
            ->withResource('points', new PointResource(Point::where('type', $type)->get()));
    }
}
