<?php

namespace Grocelivery\Geolocalizer\Console;

use Grocelivery\Geolocalizer\Console\Commands\InitPointsCollection;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 * @package Grocelivery\Geolocalizer\Console
 */
class Kernel extends ConsoleKernel
{
    /** @var array */
    protected $commands = [
        InitPointsCollection::class,
    ];

    /**
     * @param Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
    }
}
