<?php

namespace Alignwebs\LaravelGooglePlacesAutocomplete;

use Illuminate\Support\Facades\Http;

class LaravelGooglePlacesAutocomplete
{
    const GOOGLE_PLACES_AUTOCOMPLETE_API_URL = 'https://maps.googleapis.com/maps/api/place/autocomplete/json';

    private $gmapApiKey = '';
    private $fields = ['description', 'place_id'];
    private ?array $location = null;
    private ?array $searchableCountries = null;
    private int|float|null $radius = null; // in meters
    private string|null $apiResponseStatus = null;
    private string|null $apiResponseErrorMessage = null;

    public function __construct($gmapApiKey = null)
    {
        $this->gmapApiKey = $gmapApiKey ?? config('google-places-autocomplete.google_api_key');
    }

    public function getApiKey()
    {
        return $this->gmapApiKey;
    }

    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function setLocation(float $lat, float $lon)
    {
        $this->location = [$lat, $lon];
    }

    public function getLocation(): ?array
    {
        return $this->location;
    }

    public function setSearchableCountries(array $countries)
    {
        if (count($countries) == 0) {
            throw new \Exception("Searchable countries array can't be empty");
        }

        if (count($countries) > 5) {
            throw new \Exception("Searchable countries array can't have more than 5 countries");
        }

        $this->searchableCountries = $countries;
    }

    public function getSearchableCountries(): ?array
    {
        return $this->searchableCountries;
    }

    public function setRadius(int|float $radius)
    {
        $this->radius = $radius;
    }

    public function getRadius(): int|float|null
    {
        return $this->radius;
    }

    public function getApiResponseStatus(): string|null
    {
        return $this->apiResponseStatus;
    }

    public function getApiResponseErrorMessage(): string|null
    {
        return $this->apiResponseErrorMessage;
    }

    private function setApiResponseStatus(string $api_response_status)
    {
        $this->apiResponseStatus = $api_response_status;
    }

    private function setApiResponseErrorMessage(string $api_response_error_message)
    {
        $this->apiResponseErrorMessage = $api_response_error_message;
    }

    public function search(string $query)
    {
        $payload['key'] = $this->gmapApiKey;
        $payload['input'] = $query;

        if (!is_null($this->getLocation())) {
            $payload['location'] = implode(',', $this->getLocation());
        }
        if (!is_null($this->getRadius())) {
            $payload['radius'] = $this->getRadius();
        }
        if (!is_null($this->getSearchableCountries())) {
            $searchableCountries = $this->getSearchableCountries();
            $payload['components'] = 'country:' . implode('|country:', $searchableCountries);
        }

        $response = Http::get(self::GOOGLE_PLACES_AUTOCOMPLETE_API_URL, $payload);

        if ($response->failed()) {
            throw new \Exception('Google Places Autocomplete API call failed. Server Error: ' . $response->serverError() . ' | Client Error: ' . $response->clientError());
        }
        
        $response = $response->json();

        $this->setApiResponseStatus($response['status']);

        if (isset($response['error_message'])) {
            $this->setApiResponseErrorMessage($response['error_message']);
        }

        $predictions = $response['predictions'];
        $result = collect($predictions)->map(function ($prediction) {
            return collect($prediction)->only($this->fields)->all();
        });

        return $result;
    }
}
