<?php

namespace Grocelivery\Geolocalizer\Http\Requests\Geocoding;

use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class Autocomplete
 * @package Grocelivery\Geolocalizer\Http\Requests\Geocoding
 */
class Autocomplete extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'query' => 'required|string',
            'country' => 'string',
        ];
    }
}