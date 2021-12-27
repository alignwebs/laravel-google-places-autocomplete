# Laravel Google Places Autocomplete
Laravel wrapper for Google Places Autocomplete API

## Installation
`composer require alignwebs/laravel-google-places-autocomplete`

## Example Code:
```
<?php
use Alignwebs\LaravelGooglePlacesAutocomplete\Services\GooglePlacesAutocomplete;

$google_places_autocomplete = new GooglePlacesAutocomplete('API_KEY');

$google_places_autocomplete->setLocation(27.8880047, 81.9632554); // Optional
$google_places_autocomplete->setRadius(5000); // Optional

$result = $google_places_autocomplete->search("new street");
```
