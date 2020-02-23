<?php

namespace Grocelivery\Geolocalizer\Services;

use Grocelivery\Utils\Clients\RestClient;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;

class MapboxClient extends RestClient
{
    protected $query = [];

    /**
     * @param string $query
     * @param string $country
     * @return Collection
     */
    public function search(string $query, string $country = ""): Collection
    {
        $this->setQueryParameter('types', 'address');
        $this->setQueryParameter('country', $country);

        $response = $this->get("/geocoding/v5/mapbox.places/$query.json" . $this->getQuery());

        return collect($response->get('features'));
    }

    /**
     * @param string $query
     * @param string $country
     * @return Collection
     */
    public function autocomplete(string $query, string $country = ""): Collection
    {
        $this->setQueryParameter('types', 'address');
        $this->setQueryParameter('country', $country);
        $this->setQueryParameter('autocomplete', true);

        $response = $this->get("/geocoding/v5/mapbox.places/$query.json" . $this->getQuery());

        return collect($response->get('features'));
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return Collection
     */
    public function reverse(float $latitude, float $longitude): Collection
    {
        $this->setQueryParameter('types', 'address');
        $response = $this->get("/geocoding/v5/mapbox.places/$latitude,$longitude.json" . $this->getQuery());

        return collect($response->get('features'));
    }

    /**
     * @param string $poi
     * @param float $latitude
     * @param float $longitude
     * @return Collection
     */
    public function poi(string $poi, float $latitude, float $longitude): Collection
    {
        $this->setQueryParameter('proximity', "$latitude,$longitude");

        $response = $this->get("/geocoding/v5/mapbox.places/$poi.json" . $this->getQuery());

        return collect($response->get('features'));
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
        return config('mapbox.host');
    }

    /**
     * @return string
     */
    protected function getQuery(): string
    {
        $this->setQueryParameter('access_token', config('mapbox.accessToken'));
        return '?' . http_build_query($this->query);
    }

    /**
     * @return array
     */
    protected function buildOptions(): array
    {
        return [
            RequestOptions::SYNCHRONOUS => true,
        ];
    }
}