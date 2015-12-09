<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('alpha_spaces', function($attribute, $value, $parameters, $validator) {
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        Validator::extend('alpha_spaces_num', function($attribute, $value, $parameters, $validator) {
            return preg_match('/^[\pL\s\pN]+$/u', $value);
        });

        Validator::extend('alpha_spaces_num_dot', function($attribute, $value, $parameters, $validator) {
            return preg_match('/^[\pL\s\pN.]+$/u', $value);
        });

        Validator::extend('date_multi_format', function($attribute, $value, $formats) {
            foreach($formats as $format) {
                $parsed = date_parse_from_format($format, $value);
                if ($parsed['error_count'] === 0 && $parsed['warning_count'] === 0) {
                    return true;
                }
            }
            return false;
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
