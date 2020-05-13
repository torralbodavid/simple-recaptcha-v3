<?php

namespace Torralbodavid\SimpleRecaptchaV3;

use Illuminate\Support\ServiceProvider;

class SimpleRecaptchaV3ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'simple-recaptcha-v3');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'simple-recaptcha-v3');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('simple-recaptcha-v3.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/simple-recaptcha-v3'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/simple-recaptcha-v3'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/simple-recaptcha-v3'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'simple-recaptcha-v3');

        // Register the main class to use with the facade
        $this->app->singleton('simple-recaptcha-v3', function () {
            return new SimpleRecaptchaV3;
        });
    }
}
