<?php

namespace App\Providers;

use App\Settings;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (\Schema::hasTable('configs')) {
            foreach (Settings::all() as $setting) {
                $setting->loadInMemory();
            }
        }

        view()->composer('*', function($view){
            $view_name = str_replace('.', '-', $view->getName());
            config(['view_name' => $view_name]);
            view()->share('view_name', $view_name);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
