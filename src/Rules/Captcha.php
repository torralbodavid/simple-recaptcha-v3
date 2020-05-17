<?php

namespace Torralbodavid\SimpleRecaptchaV3\Rules;

use Illuminate\Contracts\Validation\Rule;
use Torralbodavid\SimpleRecaptchaV3\Services\Captcha as CaptchaService;

class Captcha implements Rule
{
    protected $response;

    /**
     * {@inheritdoc}
     */
    public function passes($attribute, $response)
    {
        if (! config('simple-recaptcha-v3.active')) {
            return true;
        }

        if ($response === null) {
            return false;
        }

        $captcha = new CaptchaService($response);
        $this->response = (array) $captcha->getResponse();

        if(! empty($this->response['error-codes'])) {
            return false;
        }

        if(config('simple-recaptcha-v3.hostname_check') && request()->getHttpHost() !== $this->response['hostname']) {
            return false;
        }

        if (! $this->response['success'] || $this->response['score'] < config('simple-recaptcha-v3.minimum_score')) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function message()
    {
        return "simple-recaptcha-v3::messages.{$this->response['error-codes'][0]}";
    }
}
