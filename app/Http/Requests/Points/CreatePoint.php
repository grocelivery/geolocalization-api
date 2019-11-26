<?php

namespace Grocelivery\Geolocalizer\Http\Requests\Points;

use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class CreatePoint
 * @package Grocelivery\Geolocalizer\Http\Requests\Points
 */
class CreatePoint extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'location' => 'required|array',
            'location.latitude' => 'required|numeric|min:-90|max:90',
            'location.longitude' => 'required|numeric|min:-180|max:180',
            'payload' => 'array',
        ];
    }
}