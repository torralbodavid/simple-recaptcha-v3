<?php

return [
    'active' => env('CAPTCHA_ENABLED', true),
    'site_key' => env('CAPTCHA_SITE_KEY', ''),
    'secret_key' => env('CAPTCHA_SECRET_KEY', ''),
    'minimum_score' => env('CAPTCHA_MINIMUM_SCORE', 0.5),
];
