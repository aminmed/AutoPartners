<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function() {
            return base_path('/public');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('*', function ($view)
        {
            $settings = [];
            foreach (Setting::all() as $setting) {
                if (in_array($setting->key, ['title', 'keywords', 'description'])) {
                    $settings[$setting->key] = $setting->value;
                }else {
                    $settings[$setting->key] = json_decode($setting->value, true);
                }
                
            }

            $view->with(compact('settings'));  
        });
    }
}
