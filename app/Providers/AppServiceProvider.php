<?php

namespace App\Providers;

use Braintree\Gateway;
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
     * @return void
     */
    public function boot()
    {

        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'y9fkzm9y4q49xcj9',
                    'publicKey' => '3fnr9cgv7m9np7jk',
                    'privateKey' => '2da53a8b5bb018cc97cbb836b086de40'
                ]
            );
        });
    }
}
