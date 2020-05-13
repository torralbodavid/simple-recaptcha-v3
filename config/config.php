<?php

return [
    'active' => env('CAPTCHA_ENABLED', true),
    'site_key' => env('CAPTCHA_SITE_KEY', ''),
    'secret_key' => env('CAPTCHA_SECRET_KEY', ''),
    'minimum_score' => env('CAPTCHA_MINIMUM_SCORE', 0.5),

    /*
     * Before hide badge, you may read https://developers.google.com/recaptcha/docs/faq#id-like-to-hide-the-recaptcha-badge.-what-is-allowed
     */
    'hide_badge' => env('CAPTCHA_HIDE_BADGE', false),
    'prefer_navigator_language' => env('CAPTCHA_PREFER_NAVIGATOR_LANGUAGE', false),
];
