<?php

namespace Alignwebs\LaravelGooglePlacesAutocomplete;

use Alignwebs\LaravelGooglePlacesAutocomplete\Skeleton\SkeletonClass;
use Illuminate\Support\Facades\Facade;

/**
 * @see SkeletonClass
 */
class LaravelGooglePlacesAutocompleteFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'google-places-autocomplete';
    }
}
