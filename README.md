<h1 align="center">IBM Watson - Tone Analyzer</h1>
<p align="center">

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![SensioLabs Insights][ico-sensiolabs]][link-sensiolabs]
[![Total Downloads][ico-downloads]][link-downloads]

</p>

---
[Installation](#installation)  
[Usage](#usage)  
[Change Log](#change-log)  
[Testing](#testing)  
[Contributing](#contributing)  
[Security](#security)  
[Credits](#credits)  
[License](#license)  
---

## Install

This library does not impose a specific dependency for sending HTTP requests. Instead we use [HTTPlug](http://httplug.io/) abstraction library to allows to continue using your existing HTTP implementation or use your favoured one.

We also are utilising [PSR-7](http://www.php-fig.org/psr/psr-7/) in this library so you will need to install a `psr-7` compatible library such as [`guzzlehttp/psr7`](https://github.com/guzzle/psr7).

We can do this with a one line composer require:

```
$ composer require php-http/curl-client guzzlehttp/psr7 php-http/message adam-paterson/ibm-watson-sdk
```

## Usage

### Configuring custom client
```php
// Create HTTP client with plugins
$httpClient = (new Builder())
    ->withCredentials('username', 'password')
    ->withEndpoint('url')
    ->appendPlugin(new CachePlugin(), new ErrorPlugin())
    ->createConfiguredClient();
 
// Use ArrayHydrator
$hydrator = new IBM\Watson\Common\Hydrator\ArrayHydrator()    
 
// Use custom request builder
$requestBuilder = new CustomRequestBuilder();
 
$toneAnalyzer = new IBM\Watson\ToneAnalyzer($httpClient, $hydrator, $requestBuilder);
``` 

### Document Tone Analysis
``` php
$toneAnalyzer = IBM\Watson\ToneAnalyzer::create('username', 'password');
  
$tones = $toneAnalyzer->tone()->analyze('Some text to analyze', [
    'tones' => 'emotion'
]);
  
foreach ($tones as $tone) {
    echo $tone->getName() . ' : ' . $tone->getScore() . PHP_EOL;
}
```

### Chat Tone Analysis
```php
$toneAnalyzer = IBM\Watson\ToneAnalyzer::create('username', 'password');
 
$tones = $toneAnalyzer->toneChat()->analyze('Some text to analyze');
 
foreach ($tones as $tone) {
    echo $tone->getName() . ' : ' . $tone->getScore() . PHP_EOL;
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Adam Paterson][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/adam-paterson/ibm-watson-sdk.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/adam-paterson/ibm-watson-sdk/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/adam-paterson/ibm-watson-sdk.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/adam-paterson/ibm-watson-sdk.svg?style=flat-square
[ico-sensiolabs]: https://img.shields.io/sensiolabs/i/ae060475-0619-487c-bfdf-7d763574b7b9.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/adam-paterson/ibm-watson-sdk.svg?style=flat-square


[link-packagist]: https://packagist.org/packages/adam-paterson/ibm-watson-sdk
[link-travis]: https://travis-ci.org/adam-paterson/ibm-watson-sdk
[link-scrutinizer]: https://scrutinizer-ci.com/g/adam-paterson/ibm-watson-sdk/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/adam-paterson/ibm-watson-sdk
[link-sensiolabs]: https://insight.sensiolabs.com/projects/ae060475-0619-487c-bfdf-7d763574b7b9
[link-downloads]: https://packagist.org/packages/adam-paterson/ibm-watson-sdk
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors
