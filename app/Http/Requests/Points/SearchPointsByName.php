<?php

namespace Grocelivery\Geolocalizer\Http\Requests\Points;

use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class SearchPointsByName
 * @package Grocelivery\Geolocalizer\Http\Requests\Points
 */
class SearchPointsByName extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}