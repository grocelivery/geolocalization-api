<?php

namespace Grocelivery\Geolocalizer\Http\Requests;

use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class Search
 * @package Grocelivery\Geolocalizer\Http\Requests
 */
class Search extends FormRequest
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