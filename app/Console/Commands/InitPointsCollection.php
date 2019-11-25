<?php

namespace Grocelivery\Geolocalizer\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;

/**
 * Class InitPointsCollection
 * @package Grocelivery\Geolocalizer\Console\Commands
 */
class InitPointsCollection extends Command
{
    /** @var string */
    protected $signature = 'points:init {--fresh= : Drops existing collection if exists}';
    /** @var string */
    protected $description = 'Creates mongo geo points collection and sets proper indexes in it.';

    public function handle(): void
    {
        if ($this->hasOption('fresh') && Schema::hasTable('points')) {
            Schema::drop('points');
            $this->info('Dropped existing collection.');
        }

        Schema::create('points', function (Blueprint $collection): void {
            $collection->geospatial('location', '2dsphere');
            $collection->index(['name' => 'text'], 'name');
        });

        $this->info('Successfully created points collection.');
    }
}