<?php

namespace Grocelivery\Geolocalizer\Http\Resources;

use Grocelivery\Utils\Resources\JsonResource;

/**
 * Class ReverseSearchResults
 * @package Grocelivery\Geolocalizer\Http\Resources
 */
class ReverseSearchResults extends JsonResource
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->resource['display_name'],
            'address' => $this->resource['address'],
            'location' => [
                'latitude' => $this->resource['lat'],
                'longitude' => $this->resource['lon'],
            ]
        ];
    }
}