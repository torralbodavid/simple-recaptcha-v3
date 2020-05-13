<?php

namespace Torralbodavid\SimpleRecaptchaV3\Tests;

use Orchestra\Testbench\TestCase;
use Torralbodavid\SimpleRecaptchaV3\SimpleRecaptchaV3ServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [SimpleRecaptchaV3ServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
