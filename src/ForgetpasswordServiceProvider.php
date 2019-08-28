<?php

namespace codenrx\forgetpassword;

use Illuminate\Support\ServiceProvider;

class ForgetpasswordServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/views', 'forgetpassword');
        $this->publishes([
            __DIR__ . '/views' => resource_path('views/vendor/email'),
            __DIR__ . '/config/forgetpassword.php' => config_path('forgetpassword.php'),
        ]);
    }

    public function register()
    {
        # code...
    }
}
