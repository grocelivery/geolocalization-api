<?php

namespace Grocelivery\Geolocalizer\Services;

use Grocelivery\Utils\Clients\RestClient;
use Grocelivery\Utils\Exceptions\RestClientException;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

/**
 * Class LocationIqClient
 * @package Grocelivery\Geolocalizer\Services
 */
class LocationIqClient extends RestClient
{
    /** @var array */
    protected $query = [];

    /**
     * @param string $query
     * @param string $country
     * @return Collection
     */
    public function search(string $query, string $country = null): Collection
    {
        $this->setQueryParameter('q', $query);

        if ($country) {
            $this->setQueryParameter('countrycodes', $country);
        }

        $response = $this->get('/autocomplete.php' . $this->buildQueryString());

        return collect($response->getBody())->whereIn('type', ['city', 'town', 'village']);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return Collection
     */
    public function reverse(float $latitude, float $longitude): Collection
    {
        $this->setQueryParameter('lat', $latitude);
        $this->setQueryParameter('lon', $longitude);
        $this->setQueryParameter('format', 'json');

        $results = [];

        try {
            $response = $this->get('/reverse.php' . $this->buildQueryString());
            $results[] = $response->getBody();
        } catch (RestClientException $exception) {
            if ($exception->getCode() === Response::HTTP_NOT_FOUND) {
                $results[] = [];
            }
        }

        return collect($results);
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setQueryParameter(string $key, string $value): void
    {
        $this->query[$key] = $value;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return config('location-iq.host');
    }

    /**
     * @return string
     */
    protected function getKey(): string
    {
        return config('location-iq.key');
    }

    /**
     * @return string
     */
    protected function buildQueryString(): string
    {
        $this->query['key'] = $this->getKey();
        $this->query['normalizecity'] = 1;
        return '?' . http_build_query($this->query);
    }
}