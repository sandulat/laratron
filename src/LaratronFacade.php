<?php

declare(strict_types=1);

namespace Sandulat\Laratron;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sandulat\Laratron\Skeleton\SkeletonClass
 */
final class LaratronFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laratron';
    }
}
