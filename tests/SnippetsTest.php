<?php

namespace Torralbodavid\SimpleRecaptchaV3\Tests;

class SnippetsTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        config()->set('simple-recaptcha-v3.site_key', 'site_key');
    }

    /** @test */
    public function view_has_site_key()
    {
        $renderedView = view('captcha')->render();

        $this->assertStringContainsString('site_key', $renderedView);
    }

    /** @test */
    public function when_hide_badge_option_is_true_show_styles()
    {
        config()->set('simple-recaptcha-v3.hide_badge', true);

        $renderedView = view('captcha')->render();

        $this->assertStringContainsString('<style> .grecaptcha-badge { visibility: hidden; } </style>', $renderedView);
    }

    /** @test */
    public function when_hide_badge_option_is_false_hide_styles()
    {
        config()->set('simple-recaptcha-v3.site_key', 'site_key');
        config()->set('simple-recaptcha-v3.hide_badge', false);

        $renderedView = view('captcha')->render();

        $this->assertStringNotContainsString('<style> .grecaptcha-badge { visibility: hidden; } </style>', $renderedView);
    }

    /** @test */
    public function captcha_loads_with_locale_language_when_enabled()
    {
        config()->set('simple-recaptcha-v3.prefer_navigator_language', false);
        app()->setLocale('es');
        $renderedView = view('captcha')->render();

        $this->assertStringContainsString('&amp;hl=es', $renderedView);
    }

    /** @test */
    public function captcha_loads_with_navigator_language_when_disabled()
    {
        config()->set('simple-recaptcha-v3.prefer_navigator_language', true);
        app()->setLocale('es');
        $renderedView = view('captcha')->render();

        $this->assertStringNotContainsString('&amp;hl=es', $renderedView);
    }

    /** @test */
    public function if_captcha_is_disabled_does_not_load_scripts()
    {
        config()->set('simple-recaptcha-v3.active', false);
        $renderedView = view('captcha')->render();

        $this->assertStringNotContainsString('<script src="https://www.google.com/recaptcha/api.js?render=', $renderedView);
        $this->assertStringNotContainsString('function prepareCaptcha(action, id) {', $renderedView);
        $this->assertStringNotContainsString('<input type="hidden" name="recaptcha_response"', $renderedView);
    }

    /** @test */
    public function if_captcha_is_enabled_loads_scripts()
    {
        config()->set('simple-recaptcha-v3.active', true);
        $renderedView = view('captcha')->render();

        $this->assertStringContainsString('<script src="https://www.google.com/recaptcha/api.js?render=', $renderedView);
        $this->assertStringContainsString('function prepareCaptcha(action, id) {', $renderedView);
        $this->assertStringContainsString('<input type="hidden" name="recaptcha_response"', $renderedView);
    }
}
