<?php

namespace App\Providers;

use DB;
use Illuminate\Pagination\Paginator;
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
        DB::connection()->getPdo()->sqliteCreateFunction("REGEXP", "preg_match", 2);
        Paginator::useBootstrap();
    }
}
