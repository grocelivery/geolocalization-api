<?php

namespace Grocelivery\Geolocalizer\Http\Requests\Points;

use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class CreatePoint
 * @package Grocelivery\Geolocalizer\Http\Requests\Points
 */
class ReplacePoints extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'points' => 'required|array',
            'points.*' => 'array',
            'points.*.name' => 'required|string',
            'points.*.location' => 'required|array',
            'points.*.location.latitude' => 'required|numeric|min:-90|max:90',
            'points.*.location.longitude' => 'required|numeric|min:-180|max:180',
            'points.*.payload' => 'array',
        ];
    }
}