<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->get('/', 'Controller@getInfo');

$router->group(['middleware' => 'auth'], function () use ($router): void {
    $router->post('/points/{type}', 'Points\CreateController@createPoint');
    $router->put('/points/{type}', 'Points\CreateController@replacePoints');
    $router->get('/points/{type}', 'Points\SearchController@getPoints');
    $router->get('/points/{type}/{id}', 'Points\SearchController@getPoint');
    $router->get('/points/{type}/search/range', 'Points\SearchController@searchPointsInRange');
    $router->get('/points/{type}/search/name', 'Points\SearchController@searchPointsByName');

    $router->get('/geocoding/autocomplete', 'Geocoding\SearchController@autocomplete');
    $router->get('/geocoding/search', 'Geocoding\SearchController@search');
    $router->get('/geocoding/reverse', 'Geocoding\SearchController@reverse');
    $router->get('/geocoding/nearby', 'Geocoding\SearchController@nearby');
});
