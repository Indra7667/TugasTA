<?php

namespace App\Providers;
// use Carbon\Carbon;
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
        // view composer (only usable in views so I have no intention on using this. Even so, I'll left this here)
        // view()->composer('*', function($view){
        //     $view->with('now', Carbon::now());
        //     $view->with('today', Carbon::today());
        // });
    }
}
