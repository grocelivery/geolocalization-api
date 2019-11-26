<?php

namespace Grocelivery\Geolocalizer\Http\Resources;

use Grocelivery\Utils\Resources\JsonResource;

/**
 * Class NearbySearchResults
 * @package Grocelivery\Geolocalizer\Http\Resources
 */
class NearbySearchResults extends JsonResource
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->resource['name'] ?? '',
            'distance' => $this->resource['distance'] / 1000,
            'location' => [
                'latitude' => $this->resource['lat'],
                'longitude' => $this->resource['lon'],
            ],
        ];
    }
}