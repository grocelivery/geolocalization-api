<?php

namespace Grocelivery\Geolocalizer\Http\Resources;

use Grocelivery\Utils\Resources\JsonResource;

/**
 * Class AutocompleteResult
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
            'type' => $this->resource['type'],
            'name' => $this->resource['display_place'],
            'fullName' => $this->resource['display_name'],
            'address' => [
                'display' => $this->resource['display_address'],
                'elements' => $this->resource['address']
            ],
            'location' => [
                'latitude' => $this->resource['lat'],
                'longitude' => $this->resource['lon'],
            ]
        ];
    }
}