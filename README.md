# Simple reCAPTCHA v3 integration

[![Latest Version on Packagist](https://img.shields.io/packagist/v/torralbodavid/simple-recaptcha-v3.svg?style=flat-square)](https://packagist.org/packages/torralbodavid/simple-recaptcha-v3)
[![Build Status](https://travis-ci.org/torralbodavid/simple-recaptcha-v3.svg?branch=master)](https://travis-ci.org/torralbodavid/simple-recaptcha-v3)
[![StyleCI](https://github.styleci.io/repos/263758912/shield)](https://github.styleci.io/repos/263758912)
[![Quality Score](https://img.shields.io/scrutinizer/g/torralbodavid/simple-recaptcha-v3.svg?style=flat-square)](https://scrutinizer-ci.com/g/torralbodavid/simple-recaptcha-v3)
[![Total Downloads](https://img.shields.io/packagist/dt/torralbodavid/simple-recaptcha-v3.svg?style=flat-square)](https://packagist.org/packages/torralbodavid/simple-recaptcha-v3)

This repository contains simple reCAPTCHA v3 integration for your Laravel application.

## Installation

You can install the package via composer:

```bash
    composer require torralbodavid/simple-recaptcha-v3
```

## Usage

1. Set the following variables in your .env

Override xxxxx with your reCaptcha v3 keys. Get yours [here](https://www.google.com/recaptcha/admin)

```
    CAPTCHA_SITE_KEY=xxxxx
    CAPTCHA_SECRET_KEY=xxxxx
```

Optionally, you can publish the config file of the package. You will be able to customize advanced settings, such as:

* Disabling reCaptcha v3
* Minimum score you should get in order to validate your form
* Hostname validation
* Hide reCaptcha badge
* Prefer navigator language on reCaptcha badge

```
    php artisan vendor:publish --provider="Torralbodavid\SimpleRecaptchaV3\SimpleRecaptchaV3ServiceProvider" --tag=config
```

2. To get started, you must include at the very bottom of your head tag from the pages you want to protect with reCaptcha, the `@captcha_init` blade directive. This will start loading Google reCAPTCHA API.

```html
    <html>
        <head>
            ...
            
            @captcha_init
        </head>
    </html>
```

3. Include below your form initialization tag, the `@captcha('xxxx')` blade directive. Replace xxxx with your desired [action](https://developers.google.com/recaptcha/docs/v3#actions).

```html
    <form method="..." action="...">
        @captcha('login')
        ...
    </form>
```

4. To sum up, add the following rule on your form validation:

```php
    'recaptcha_response' => new Captcha
```

```php
    use Torralbodavid\SimpleRecaptchaV3\Rules\Captcha;
    
    ...
    
    $request->validate([
        ...
        'recaptcha_response' => new Captcha,
    ]);
```

### Customize error messages

You can customize reCaptcha v3 error messages by publishing the translations on your project.

```bash
    php artisan vendor:publish --provider="Torralbodavid\SimpleRecaptchaV3\SimpleRecaptchaV3ServiceProvider" --tag=lang
```

### Customize snippets

You can customize @captcha and @captcha_init snippets by publishing the views on your project

```bash
    php artisan vendor:publish --provider="Torralbodavid\SimpleRecaptchaV3\SimpleRecaptchaV3ServiceProvider" --tag=views
```

### Disable reCaptcha v3 integration in tests

You can easily disable reCaptcha v3 integration in your tests by adding the following configuration on them

```php
   config()->set('simple-recaptcha-v3.active', false);
```

### Testing

``` bash
    composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email davidtorralboperez@gmail.com instead of using the issue tracker.

## Credits

- [David Torralbo Pérez](https://github.com/torralbodavid)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

Have fun!
