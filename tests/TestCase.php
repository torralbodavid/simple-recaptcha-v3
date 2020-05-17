<?php

namespace Torralbodavid\SimpleRecaptchaV3\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Torralbodavid\SimpleRecaptchaV3\SimpleRecaptchaV3ServiceProvider;
use Illuminate\Support\Facades\View;

class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        View::addLocation(__DIR__.'/views');

    }

    protected function getPackageProviders($app)
    {
        return [SimpleRecaptchaV3ServiceProvider::class];
    }

}
