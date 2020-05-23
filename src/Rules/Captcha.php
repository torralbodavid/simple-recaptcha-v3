<?php

namespace Torralbodavid\SimpleRecaptchaV3\Rules;

use Illuminate\Contracts\Validation\Rule;
use Torralbodavid\SimpleRecaptchaV3\Services\Captcha as CaptchaService;

class Captcha implements Rule
{
    protected $serviceResponse;
    protected $userResponse;

    /**
     * {@inheritdoc}
     */
    public function passes($attribute, $response)
    {
        if (! config('simple-recaptcha-v3.active')) {
            return true;
        }

        $this->userResponse = $response;

        if ($this->userResponse === null) {
            return false;
        }

        $this->serviceResponse = $this->getResponse(new CaptchaService());

        if (! empty($this->serviceResponse['error-codes'])) {
            return false;
        }

        if (config('simple-recaptcha-v3.hostname_check') && request()->getHttpHost() !== $this->serviceResponse['hostname']) {
            return false;
        }

        if (! $this->serviceResponse['success'] || $this->serviceResponse['score'] < config('simple-recaptcha-v3.minimum_score')) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function message()
    {
        return "simple-recaptcha-v3::messages.{$this->serviceResponse['error-codes'][0]}";
    }

    protected function getResponse(CaptchaService $service): array
    {
        return (array) $service($this->userResponse);
    }
}
