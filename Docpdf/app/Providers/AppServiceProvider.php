<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Documents;
use App\Observers\DocumentObserver;


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
        //

            Documents::observe(DocumentObserver::class);

    }
}
