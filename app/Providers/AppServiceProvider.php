<?php

namespace App\Providers;

use App\Models\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use URL;

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
        Model::unguard();
        // JsonResource::withoutWrapping();
        Schema::defaultStringLength(191);
        if (config('app.force_https')){
            URL::forceScheme("https");
        }
    }
}
