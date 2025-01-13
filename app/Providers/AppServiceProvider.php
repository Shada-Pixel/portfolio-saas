<?php

namespace App\Providers;

use App\Rules\UniqueRecordRule;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     */
    public function boot()
    {
//        Schema::defaultStringLength(160);
        \Validator::extend('is_unique', function ($attribute, $value, $parameters, $validator) {
            list($table, $column) = $parameters;

            $updateFieldValue = isset($parameters[2]) ? $parameters[2] : null;
            return (new UniqueRecordRule($table, $column, $updateFieldValue))->passes($attribute, $value);
        });


        $this->app->bind('path.public', function() {
            return base_path().'/../public_html';
        });
    }
}
