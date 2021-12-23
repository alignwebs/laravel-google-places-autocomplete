<?php

namespace Alignwebs\LaravelGooglePlacesAutocomplete;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Alignwebs\LaravelGooglePlacesAutocomplete\Skeleton\SkeletonClass
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
