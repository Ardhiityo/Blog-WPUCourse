<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\QueryExecuted;

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
        DB::listen(function (QueryExecuted $queryExecuted) {
            // Log::info(json_encode($queryExecuted->sql, JSON_PRETTY_PRINT));
        });

        // Mewajibkan eager loading disetiap relasi, apabila ada lazy loading maka akan error : Attempted to lazy load [user] on model [App\Models\Post] but lazy loading is disabled.
        Model::preventLazyLoading();
    }
}
