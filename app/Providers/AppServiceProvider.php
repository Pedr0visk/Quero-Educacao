<?php

namespace App\Providers;

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
        // $this->app->singleton(PaymentGatewayContract::class, function ($app) {

        //     if (request()->has('credit')) {
        //         return new CreditPaymentGateway('usd');
        //     }

        //     return new BankPaymentGateway('usd');
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
