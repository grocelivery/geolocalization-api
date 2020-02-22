<?php

namespace Grocelivery\Geolocalizer\Http\Requests\Geocoding;

use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class SearchNearby
 * @package Grocelivery\Geolocalizer\Http\Requests\Geocoding
 */
class SearchPOIs extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'poi' => 'required|string',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
        ];
    }
}