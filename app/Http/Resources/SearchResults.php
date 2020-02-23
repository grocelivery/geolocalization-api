<?php

namespace Grocelivery\Geolocalizer\Http\Resources;

use Grocelivery\Utils\Resources\JsonResource;

/**
 * Class SearchResults
 * @package Grocelivery\Geolocalizer\Http\Resources
 */
class SearchResults extends JsonResource
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'address' => $this->resource['place_name'],
            'place' => $this->resource['text'],
            'location' => [
                'longitude' => $this->resource['geometry']['coordinates'][0],
                'latitude' => $this->resource['geometry']['coordinates'][1],
            ]
        ];
    }
}