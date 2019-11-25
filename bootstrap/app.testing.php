<?php

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__), '.env.testing'
))->bootstrap();

return require __DIR__.'/base.php';
