<?php

// config for Tor2r/BrregApi
return [

    /*
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for the Brønnøysundregisteret API.
    |
    */
    'base_url' => env('BRREG_API_BASE_URL', 'https://data.brreg.no'),

    /*
    |--------------------------------------------------------------------------
    | Results Per Page
    |--------------------------------------------------------------------------
    |
    | The default number of results to return when searching.
    |
    */
    'results_per_page' => env('BRREG_API_RESULTS_PER_PAGE', 100),

];
