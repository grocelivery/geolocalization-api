<?php

declare(strict_types=1);

namespace Grocelivery\Geolocalizer\Http\Requests\Points;


use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class GetPoints
 * @package Grocelivery\Geolocalizer\Http\Requests\Points
 */
class GetPoints extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'select' => 'array',
            'select.*' => 'string',
            'limit' => 'int',
        ];
    }
}