<?php

declare(strict_types=1);

namespace App\Providers;

use Braintree\Configuration;
use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class BraintreeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
    }

    /**
     * @throws \Braintree\Exception\Configuration
     */
    public function register(): void
    {
        $config = new Configuration([
            'environment' => config('app.braintree.environment'),
            'merchantId' => config('app.braintree.merchantId'),
            'publicKey' => config('app.braintree.publicKey'),
            'privateKey' => config('app.braintree.privateKey'),
        ]);

        $this->app->singleton(Gateway::class, static function () use ($config) {
            return new Gateway($config);
        });
    }
}
