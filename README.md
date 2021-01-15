# laravel-log-enhancement

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![CircleCI](https://circleci.com/gh/OnrampLab/laravel-log-enhancement.svg?style=shield)](https://circleci.com/gh/OnrampLab/laravel-log-enhancement)
[![Total Downloads](https://img.shields.io/packagist/dt/onramplab/laravel-log-enhancement.svg?style=flat-square)](https://packagist.org/packages/onramplab/laravel-log-enhancement)

A library with logging enhancement. Including:

- `LoggerFacade` facade
  - It extends default Laravel `Log` facade with logging adding class path and tracking id into context.
- `LogglyHandler` class
  - It extends monolog's LogglyHandler with tags support

## Install

```bash
composer require onramplab/laravel-log-enhancement
```

## Usage

### LoggerFacade

Replace the class of `Log` alias to `LoggerFacade` in `config/app.php` as aliases.

```php
'Log' => Onramplab\LaravelLogEnhancement\Facades\LoggerFacade::class,
```

The log json will look like this:

```json
{
  "message": "Test",
  "context": {
    "class_path": "App\\Fake",
    "tracking_id": "652c3456-1a17-42b8-9fa7-9bee65e655eb"
  },
  "level": 200,
  "level_name": "INFO",
  "channel": "local",
  "extra": {},
  "timestamp": "2021-01-04T22:47:56.598608-0800"
}
```

### LogglyHandler

You can adding following block into `config/logging.php`.

```php
use Monolog\Formatter\LogglyFormatter;
use Onramplab\LaravelLogEnhancement\Handlers\LogglyHandler;

return [
  //...


  'channels' => [
    //...

    'loggly' => [
        'driver' => 'monolog',
        'level' => 'info',
        'handler' => LogglyHandler::class,
        'handler_with' => [
            'token' => env('LOGGLY_TOKEN'),
            'tags' => env('LOGGLY_TAGS'),
        ],
        'formatter' => LogglyFormatter::class,
    ],
  ]
];

```

## Testing

Run the tests with:

```bash
vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security-related issues, please email kos.huang@onramplab.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.# laravel-log-enhancement
