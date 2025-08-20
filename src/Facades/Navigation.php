<?php

namespace Fuelviews\Navigation\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fuelviews\Navigation\Navigation
 */
class Navigation extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'navigation';
    }
}
