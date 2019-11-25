<?php

namespace Grocelivery\Geolocalizer\Models;

use Jenssegers\Mongodb\Eloquent\Model as BaseModel;
use Jenssegers\Mongodb\Eloquent\Builder;

abstract class Model extends BaseModel
{
    /**
     * @param Builder $query
     * @param string $search
     * @return Builder
     */
    public function scopeWhereFullText(Builder $query, string $search): Builder
    {
        return $query->whereRaw([
            '$text' => [
                '$search' => $search
            ]
        ]);
    }

    /**
     * @param Builder $query
     * @param float $latitude
     * @param float $longitude
     * @param int $kilometers
     * @return Builder
     */
    public function scopeWhereNear(Builder $query, float $latitude, float $longitude, int $kilometers): Builder
    {
        return $query->where('location', 'near', [
            '$geometry' => [
                'type' => 'Point',
                'coordinates' => [
                    $latitude,
                    $longitude,
                ],
            ],
            '$maxDistance' => $kilometers * 1000,
        ]);
    }
}