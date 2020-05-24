<?php

return [
    /*
     * Set to false if you want to disable captcha.
     */
    'active' => env('CAPTCHA_ENABLED', true),

    /*
     * Set your captcha keys here. Get yours here https://www.google.com/recaptcha/admin
     */
    'site_key' => env('CAPTCHA_SITE_KEY', ''),
    'secret_key' => env('CAPTCHA_SECRET_KEY', ''),

    /*
     * Minimum score you should get to get the form validated
     */
    'minimum_score' => env('CAPTCHA_MINIMUM_SCORE', 0.5),

    /*
     * Check if the hostname request is the same as the form validation one.
     */
    'hostname_check' => env('CAPTCHA_HOSTNAME_CHECK', true),

    /*
     * Turning this switch to true, will make captcha badge invisible.
     * Before hide badge, you may read https://developers.google.com/recaptcha/docs/faq#id-like-to-hide-the-recaptcha-badge.-what-is-allowed
     */
    'hide_badge' => env('CAPTCHA_HIDE_BADGE', false),

    /*
     * By turning on this setting, captcha badge will prefer the navigator language.
     */
    'prefer_navigator_language' => env('CAPTCHA_PREFER_NAVIGATOR_LANGUAGE', false),
];
