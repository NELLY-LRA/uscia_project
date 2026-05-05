<?php

use Illuminate\Support\Facades\Route;
use App\Models\Region;

Route::get('/regions/{countryId}', function ($countryId) {
    return Region::where('country_id', $countryId)
                 ->orderBy('name')
                 ->get(['id', 'name']);
});
