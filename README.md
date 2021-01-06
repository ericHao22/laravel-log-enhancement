# laravel-log-enhancement

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![CircleCI](https://circleci.com/gh/OnrampLab/next-starter.svg?style=shield)]()
[![Total Downloads](https://img.shields.io/packagist/dt/onramplab/laravel-log-enhancement.svg?style=flat-square)](https://packagist.org/packages/onramplab/laravel-log-enhancement)

A library with logging enhancement. Including:

  - `LogWithClassPath` trait
    - It adds convinient methods for logging to add class path into context.
  - `LogglyHandler` class
    - It extends monolog's LogglyHandler with tags support

## Install

```bash
composer require onramplab/laravel-log-enhancement
```


## Usage

### LogWithClassPath Trait
Use `LogWithClassPath` trait to let it automatically put class path into log context. You can refer to following code example.

```php
namespace App;

use Onramplab\LaravelLogEnhancement\Concerns\LogWithClassPath;

class Fake {
  use LogWithClassPath;

  public function run()
  {
    $this->info('Test');
  }
}
```

The log json will look like this:

```json
{
  "message": "Test",
  "context": {
    "class_path": "App\\Fake"
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
