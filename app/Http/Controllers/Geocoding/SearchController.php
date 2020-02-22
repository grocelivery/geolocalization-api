<?php

namespace Grocelivery\Geolocalizer\Http\Controllers\Geocoding;

use Grocelivery\Geolocalizer\Http\Controllers\Controller;
use Grocelivery\Geolocalizer\Http\Requests\Geocoding\Autocomplete;
use Grocelivery\Geolocalizer\Http\Requests\Geocoding\ReverseSearch;
use Grocelivery\Geolocalizer\Http\Requests\Geocoding\Search;
use Grocelivery\Geolocalizer\Http\Requests\Geocoding\SearchPOIs;
use Grocelivery\Geolocalizer\Http\Resources\SearchResults;
use Grocelivery\Geolocalizer\Services\MapboxClient;
use Grocelivery\Utils\Interfaces\JsonResponseInterface;
use Grocelivery\Utils\Responses\JsonResponse;

/**
 * Class SearchController
 * @package Grocelivery\Geolocalizer\Http\Controllers\Geocoding
 */
class SearchController extends Controller
{
    /** @var MapboxClient $client */
    protected $client;

    /**
     * AutocompleteController constructor.
     * @param JsonResponse $response
     * @param MapboxClient $client
     */
    public function __construct(JsonResponse $response, MapboxClient $client)
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

        return $this->response
            ->withResource('results', new SearchResults($results));
    }

    /**
     * @param Autocomplete $request
     * @return JsonResponse
     */
    public function autocomplete(Autocomplete $request): JsonResponseInterface
    {
        $results = $this->client->autocomplete($request->input('query'), $request->input('country'));

        return $this->response
            ->withResource('results', new SearchResults($results));
    }

    /**
     * @param ReverseSearch $request
     * @return JsonResponseInterface
     */
    public function reverse(ReverseSearch $request): JsonResponseInterface
    {
        $results = $this->client->reverse($request->input('latitude'), $request->input('longitude'));

        return $this->response
            ->withResource('results', new SearchResults($results));
    }

    /**
     * @param SearchPOIs $request
     * @return JsonResponseInterface
     */
    public function poi(SearchPOIs $request): JsonResponseInterface
    {
        $results = $this->client->poi($request->input('poi'), $request->input('latitude'), $request->input('longitude'));

        return $this->response
            ->withResource('results', new SearchResults($results));
    }
}