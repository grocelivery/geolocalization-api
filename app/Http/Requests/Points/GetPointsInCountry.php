<?php

declare(strict_types=1);

namespace Grocelivery\Geolocalizer\Http\Requests\Points;


use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class GetPointsInCountry
 * @package Grocelivery\Geolocalizer\Http\Requests\Points
 */
class GetPointsInCountry extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'country' => 'required|string',
        ];
    }
}