<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// version specific routes.
Route::get('/upgrade-to-v1-1-0', function () {
    Artisan::call('db:seed', [
        '--class' => 'AddDefaultPrefixCodeSeeder',
        '--force' => true,
    ]);
});
Route::get('/upgrade-to-v2-0-0', function () {
    Artisan::call('db:seed', [
        '--class' => 'CurrencySeeder',
        '--force' => true,
    ]);
});
