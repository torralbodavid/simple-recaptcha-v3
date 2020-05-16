<?php

namespace Torralbodavid\SimpleRecaptchaV3;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SimpleRecaptchaV3ServiceProvider extends ServiceProvider
{
    public function boot()
    {
         $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'simple-recaptcha-v3');
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'simple-recaptcha-v3');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('simple-recaptcha-v3.php'),
            ], 'simple-recaptcha-v3-config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/simple-recaptcha-v3'),
            ], 'simple-recaptcha-v3-views');

            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/simple-recaptcha-v3'),
            ], 'simple-recaptcha-v3-lang');
        }

        Blade::directive('captcha', function ($action) {
            return "<?php echo view('simple-recaptcha-v3::captcha', ['action' => {$action}]); ?>";
        });

        Blade::include('simple-recaptcha-v3::captcha-api', 'captcha_api');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'simple-recaptcha-v3');

        $this->app->singleton('simple-recaptcha-v3', function () {
            return new SimpleRecaptchaV3;
        });

    }
}
