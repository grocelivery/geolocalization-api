<?php

namespace Grocelivery\Geolocalizer\Http\Requests;

use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class ReverseSearch
 * @package Grocelivery\Geolocalizer\Http\Requests
 */
class ReverseSearch extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
        ];
    }
}