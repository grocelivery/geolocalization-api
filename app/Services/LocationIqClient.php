<?php

namespace Grocelivery\Geolocalizer\Services;

use Grocelivery\Geolocalizer\Exceptions\LocationIqException;
use Grocelivery\Utils\Clients\RestClient;
use Grocelivery\Utils\Exceptions\RestClientException;
use Grocelivery\Utils\Interfaces\JsonResponseInterface;
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
     * @param $method
     * @param string $path
     * @param array $options
     * @return JsonResponseInterface
     * @throws LocationIqException
     */
    public function request($method, $path = "", array $options = []): JsonResponseInterface
    {
        try {
            return parent::request($method, $path, $options);
        } catch (RestClientException $exception) {
            throw new LocationIqException("Geocoding client responded with error code: " . $exception->getCode());
        }
    }

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
     * @param string $tag
     * @param float $latitude
     * @param float $longitude
     * @param int $kilometers
     * @return Collection
     */
    public function nearby(string $tag, float $latitude, float $longitude, int $kilometers): Collection
    {
        $this->setQueryParameter('tag', $tag);
        $this->setQueryParameter('lat', $latitude);
        $this->setQueryParameter('lon', $longitude);
        $this->setQueryParameter('radius', $kilometers * 1000);

        $response = $this->get('/nearby.php' . $this->buildQueryString());

        return collect($response->getBody());
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function setQueryParameter(string $key, $value): void
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
        $this->setQueryParameter('key', $this->getKey());
        $this->setQueryParameter('normalizecity', 1);
        $this->setQueryParameter('format', 'json');

        return '?' . http_build_query($this->query);
    }
}