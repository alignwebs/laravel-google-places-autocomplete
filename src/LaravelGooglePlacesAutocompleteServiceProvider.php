<?php

namespace Alignwebs\LaravelGooglePlacesAutocomplete;

use Illuminate\Support\ServiceProvider;

class LaravelGooglePlacesAutocompleteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('google-places-autocomplete.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'google-places-autocomplete');

        // Register the main class to use with the facade
        $this->app->singleton('google-places-autocomplete', function () {
            return new LaravelGooglePlacesAutocomplete;
        });
    }
}
