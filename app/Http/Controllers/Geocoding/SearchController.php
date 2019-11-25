<?php

namespace Grocelivery\Geolocalizer\Http\Controllers\Geocoding;

use Grocelivery\Geolocalizer\Http\Controllers\Controller;
use Grocelivery\Geolocalizer\Http\Requests\ReverseSearch;
use Grocelivery\Geolocalizer\Http\Requests\Search;
use Grocelivery\Geolocalizer\Http\Resources\ReverseSearchResults;
use Grocelivery\Geolocalizer\Http\Resources\SearchResults;
use Grocelivery\Geolocalizer\Services\LocationIqClient;
use Grocelivery\Utils\Interfaces\JsonResponseInterface;
use Grocelivery\Utils\Responses\JsonResponse;

/**
 * Class SearchController
 * @package Grocelivery\Geolocalizer\Http\Controllers\Geocoding
 */
class SearchController extends Controller
{
    /** @var LocationIqClient */
    protected $client;

    /**
     * AutocompleteController constructor.
     * @param JsonResponse $response
     * @param LocationIqClient $client
     */
    public function __construct(JsonResponse $response, LocationIqClient $client)
    {
        parent::__construct($response);
        $this->client = $client;
    }

    /**
     * @param Search $request
     * @return JsonResponse
     */
    public function search(Search $request): JsonResponseInterface
    {
        $results = $this->client->search($request->input('query'), $request->input('country'));
        return $this->response->withResource('results', new SearchResults($results));
    }

    /**
     * @param ReverseSearch $request
     * @return JsonResponseInterface
     */
    public function reverse(ReverseSearch $request): JsonResponseInterface
    {
        $results = $this->client->reverse($request->input('latitude'), $request->input('longitude'));
        return $this->response->withResource('results', new ReverseSearchResults($results));
    }
}