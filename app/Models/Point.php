<?php

namespace Grocelivery\Geolocalizer\Models;

/**
 * Class Point
 * @package Grocelivery\Geolocalizer\Models
 * @property string $name
 * @property array $location
 * @property array $payload
 * @property string $type
 */
class Point extends Model
{
    /** @var array */
    protected $fillable = ['location', 'name', 'payload', 'type'];
}