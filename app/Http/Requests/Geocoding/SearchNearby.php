<?php

namespace Grocelivery\Geolocalizer\Http\Requests\Geocoding;

use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class SearchNearby
 * @package Grocelivery\Geolocalizer\Http\Requests\Geocoding
 */
class SearchNearby extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'tag' => 'required|string',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
            'kilometers' => 'required|int',
        ];
    }
}