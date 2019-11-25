<?php

namespace Grocelivery\Geolocalizer\Http\Requests;

use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class SearchPointsInRange
 * @package Grocelivery\Geolocalizer\Http\Requests
 */
class SearchPointsInRange extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'kilometers' => 'required|int',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
        ];
    }
}