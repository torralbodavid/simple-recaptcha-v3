<?php

namespace Torralbodavid\SimpleRecaptchaV3;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Torralbodavid\SimpleRecaptchaV3\Skeleton\SkeletonClass
 */
class SimpleRecaptchaV3Facade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'simple-recaptcha-v3';
    }
}
