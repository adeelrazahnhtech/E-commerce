<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facade\DateClass;
class CustomFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        // $this->app->singleton('dateclass', function () {
        //     return new DateClass();
        // });
    }

    /**
     * Bootstrap services.
     */    
    public function boot(): void
    {
       $this->app->bind('dateclass',function(){
        return new DateClass();
       });
    }
}
