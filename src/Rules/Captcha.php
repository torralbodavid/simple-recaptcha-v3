<?php

namespace Torralbodavid\SimpleRecaptchaV3\Rules;

use Illuminate\Contracts\Validation\Rule;
use Torralbodavid\SimpleRecaptchaV3\Services\Captcha as CaptchaService;

class Captcha implements Rule
{
    /**
     * {@inheritdoc}
     */
    public function passes($attribute, $value)
    {
        if (! config('simple-recaptcha-v3.active')) {
            return true;
        }

        if ($value === null) {
            return false;
        }

        $captcha = new CaptchaService($value);
        $response = $captcha->getResponse();

        if(config('simple-recaptcha-v3.hostname_check') && request()->getHttpHost() === $response->hostname) {
            return true;
        }

        if (! $response->success || $response->score < config('simple-recaptcha-v3.minimum_score')) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function message()
    {
        return 'simple-recaptcha-v3::messages.failed';
    }
}
