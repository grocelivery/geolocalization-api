<?php

namespace Grocelivery\Geolocalizer\Http\Resources;

use Grocelivery\Utils\Resources\JsonResource;

/**
 * Class PointResource
 * @package Grocelivery\Geolocalizer\Http\Resources
 */
class PointResource extends JsonResource
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->resource['name'],
            'location' => $this->resource['location'],
            'payload' => $this->resource['payload'],
            'type' => $this->resource['type'],
        ];
    }
}