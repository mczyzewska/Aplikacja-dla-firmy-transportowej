<?php

use Illuminate\Support\Facades\Route;
use App\Models\Package;

Route::middleware('api')->group(function () {
    Route::get('/packages', function () {
        return Package::all();
    });
});
