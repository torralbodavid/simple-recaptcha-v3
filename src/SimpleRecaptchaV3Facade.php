<?php

namespace Torralbodavid\SimpleRecaptchaV3;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Torralbodavid\SimpleRecaptchaV3\Skeleton\SkeletonClass
 */
class SimpleRecaptchaV3Facade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'simple-recaptcha-v3';
    }
}
