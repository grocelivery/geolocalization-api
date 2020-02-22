<?php

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Grocelivery\Geolocalizer\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    Grocelivery\Geolocalizer\Console\Kernel::class
);

$app->routeMiddleware([
    'auth' => Grocelivery\Utils\Middleware\Authenticate::class,
]);

$app->router->group([
    'namespace' => 'Grocelivery\Geolocalizer\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/api.php';
});

$app->register(Jenssegers\Mongodb\MongodbServiceProvider::class);
$app->register(Grocelivery\Utils\Providers\UtilsServiceProvider::class);

$app->withEloquent();

$app->configure('app');
$app->configure('database');
$app->configure('mapbox');
$app->configure('grocelivery');

return $app;
