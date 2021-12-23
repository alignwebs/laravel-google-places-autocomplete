# Laravel Google Places Autocomplete
Laravel wrapper for Google Places Autocomplete API

Example Code:
```
<?php
use Alignwebs\LaravelGooglePlacesAutocomplete\Services\GooglePlacesAutocomplete;

$google_places_autocomplete = new GooglePlacesAutocomplete('API_KEY');
$google_places_autocomplete->setLocation(27.8880047, 81.9632554);
$google_places_autocomplete->setRadius(5000);
$result = $google_places_autocomplete->search($validated['q']);
```