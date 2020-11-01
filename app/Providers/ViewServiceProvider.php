<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        // About
        View::composer('about', 'App\View\Composers\AboutComposer');

        // Auth
        View::composer('auth.*', 'App\View\Composers\AuthComposer');
    }
}