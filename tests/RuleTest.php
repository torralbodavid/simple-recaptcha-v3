<?php

namespace Torralbodavid\SimpleRecaptchaV3\Tests;

use Torralbodavid\SimpleRecaptchaV3\Rules\Captcha as CaptchaRule;

class RuleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('simple-recaptcha-v3.site_key', 'site_key');
    }

    /** @test */
    public function passes_if_captcha_is_disabled()
    {
        config()->set('simple-recaptcha-v3.active', false);

        $rule = new CaptchaRule();
        $this->assertTrue($rule->passes('recaptcha_response', 'response'));
    }

    /** @test */
    public function fails_if_response_is_null()
    {
        $rule = new CaptchaRule();
        $rule = $rule->passes('recaptcha_response', 'coso');

        $this->assertFalse($rule);
    }

    /** @test */
    public function return_true_if_validation_is_ok()
    {
        config()->set('simple-recaptcha-v3.secret_key', 'secret');

        $rule = $this->partialMock(CaptchaRule::class, function ($mock) {
            $mock->shouldAllowMockingProtectedMethods()
                ->shouldReceive('getResponse')
                ->once()
                ->andReturn([
                    'success' => true,
                    'score' => 0.9,
                    'challenge_ts' => '1234',
                    'hostname' => 'localhost',
                    'error-codes' => [],
                ]);
        });

        $this->assertTrue($rule->passes('recaptcha_response', 'random_response'));
    }

    /** @test */
    public function return_false_if_error_codes_found()
    {
        config()->set('simple-recaptcha-v3.secret_key', 'secret');

        $rule = $this->partialMock(CaptchaRule::class, function ($mock) {
            $mock->shouldAllowMockingProtectedMethods()
                ->shouldReceive('getResponse')
                ->once()
                ->andReturn([
                    'success' => true,
                    'score' => 0.9,
                    'challenge_ts' => '1234',
                    'hostname' => 'localhost',
                    'error-codes' => ['error' => true],
                ]);
        });

        $this->assertFalse($rule->passes('recaptcha_response', 'random_response'));
    }

    /** @test */
    public function return_false_if_hostname_does_not_match()
    {
        config()->set('simple-recaptcha-v3.secret_key', 'secret');

        $rule = $this->partialMock(CaptchaRule::class, function ($mock) {
            $mock->shouldAllowMockingProtectedMethods()
                ->shouldReceive('getResponse')
                ->once()
                ->andReturn([
                    'success' => true,
                    'score' => 0.9,
                    'challenge_ts' => '1234',
                    'hostname' => 'unsecure.website',
                    'error-codes' => [],
                ]);
        });

        $this->assertFalse($rule->passes('recaptcha_response', 'random_response'));
    }

    /** @test */
    public function return_true_if_hostname_does_not_match_but_option_is_disabled()
    {
        config()->set('simple-recaptcha-v3.secret_key', 'secret');
        config()->set('simple-recaptcha-v3.hostname_check', false);

        $rule = $this->partialMock(CaptchaRule::class, function ($mock) {
            $mock->shouldAllowMockingProtectedMethods()
                ->shouldReceive('getResponse')
                ->once()
                ->andReturn([
                    'success' => true,
                    'score' => 0.9,
                    'challenge_ts' => '1234',
                    'hostname' => 'unsecure.website',
                    'error-codes' => [],
                ]);
        });

        $this->assertTrue($rule->passes('recaptcha_response', 'random_response'));
    }

    /** @test */
    public function return_false_if_success_is_false()
    {
        config()->set('simple-recaptcha-v3.secret_key', 'secret');

        $rule = $this->partialMock(CaptchaRule::class, function ($mock) {
            $mock->shouldAllowMockingProtectedMethods()
                ->shouldReceive('getResponse')
                ->once()
                ->andReturn([
                    'success' => false,
                    'score' => 0.9,
                    'challenge_ts' => '1234',
                    'hostname' => 'localhost',
                    'error-codes' => [],
                ]);
        });

        $this->assertFalse($rule->passes('recaptcha_response', 'random_response'));
    }

    /** @test */
    public function return_false_if_score_is_not_good()
    {
        config()->set('simple-recaptcha-v3.secret_key', 'secret');
        config()->set('simple-recaptcha-v3.minimum_score', 0.5);

        $rule = $this->partialMock(CaptchaRule::class, function ($mock) {
            $mock->shouldAllowMockingProtectedMethods()
                ->shouldReceive('getResponse')
                ->once()
                ->andReturn([
                    'success' => true,
                    'score' => 0.4,
                    'challenge_ts' => '1234',
                    'hostname' => 'localhost',
                    'error-codes' => [],
                ]);
        });

        $this->assertFalse($rule->passes('recaptcha_response', 'random_response'));
    }

    /** @test */
    public function return_true_if_score_is_the_same_as_minimum_score_param()
    {
        config()->set('simple-recaptcha-v3.secret_key', 'secret');
        config()->set('simple-recaptcha-v3.minimum_score', 0.5);

        $rule = $this->partialMock(CaptchaRule::class, function ($mock) {
            $mock->shouldAllowMockingProtectedMethods()
                ->shouldReceive('getResponse')
                ->once()
                ->andReturn([
                    'success' => true,
                    'score' => 0.5,
                    'challenge_ts' => '1234',
                    'hostname' => 'localhost',
                    'error-codes' => [],
                ]);
        });

        $this->assertTrue($rule->passes('recaptcha_response', 'random_response'));
    }
}
