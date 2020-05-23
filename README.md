# Simple reCAPTCHA v3 integration

[![Latest Version on Packagist](https://img.shields.io/packagist/v/torralbodavid/simple-recaptcha-v3.svg?style=flat-square)](https://packagist.org/packages/torralbodavid/simple-recaptcha-v3)
[![Build Status](https://img.shields.io/travis/torralbodavid/simple-recaptcha-v3/master.svg?style=flat-square)](https://travis-ci.org/torralbodavid/simple-recaptcha-v3)
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

1. To get started, you must include at the very bottom of your head tag from the pages you want to protect with reCaptcha, the `@captcha_init` blade directive. This will start loading Google reCAPTCHA API.

```html
<html>
    <head>
        ...
        
        @captcha_init
    </head>
</html>
```

2. Include below your form initialization tag, the `@captcha('xxxx')` blade directive. Replace xxxx with your desired [action](https://developers.google.com/recaptcha/docs/v3#actions).

```html
<form method="..." action="...">
    @captcha('login')
    ...
</form>
```

3. To sum up, add the following rule on your form validation:

`'recaptcha_response' => new Captcha`

```php
use Torralbodavid\SimpleRecaptchaV3\Rules\Captcha;

...

$request->validate([
    ...
    'recaptcha_response' => new Captcha,
]);
```

Have fun!

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
