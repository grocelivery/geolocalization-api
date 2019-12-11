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
            'name' => $this->resource['display_name'],
            'location' => [
                'longitude' => $this->resource['lon'],
                'latitude' => $this->resource['lat']
            ]
        ];
    }
}