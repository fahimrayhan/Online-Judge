<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Services\Layout\Layout;

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
        View::share('layout', Layout::get());
        View::share('layoutKey', Layout::getlLayoutKey());
    }
}
