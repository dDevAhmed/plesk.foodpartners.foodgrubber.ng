<?php

namespace App\Providers;

use Bunny\Storage\Client;
use Bunny\Storage\Region;
use Illuminate\Support\ServiceProvider;

class BunnyCDNServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, function ($app) {
            $apiKey = env('BUNNYCDN_ACCESS_KEY');
            $storageZone = env('BUNNYCDN_STORAGE_ZONE');
            $region = env('BUNNYCDN_REGION', Region::LONDON);
    
            return new Client($apiKey, $storageZone, $region);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
