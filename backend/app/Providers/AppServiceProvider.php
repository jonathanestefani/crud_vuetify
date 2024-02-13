<?php

namespace App\Providers;

use App\Services\Company\Validator\ValidatorService as ValidatorServiceCompany;
use App\Services\Customer\Validator\ValidatorService as ValidatorServiceCustomer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('duplicatecompany', function($attribute, $value, $parameters, $validator) {
            return (new ValidatorServiceCompany())->validateDuplicateCompany($attribute, $value, $parameters, $validator);
        });

        Validator::extend('duplicatecustomer', function($attribute, $value, $parameters, $validator) {
            return (new ValidatorServiceCustomer())->validateDuplicateCustomer($attribute, $value, $parameters, $validator);
        });
    }
}
