# IBM Watson - Tone Analyzer

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

The IBM Watson&trade; Tone Analyzer service uses linguistic analysis to detect emotional and language tones in written text. The service can analyze tone at both the document and sentence levels. You can use the service to understand how your written communications are perceived and then to improve the tone of your communications. Businesses can use the service to learn the tone of their customers' communications and to respond to each customer appropriately, or to understand and improve their customer conversations.

**Note:** Request logging is disabled for the Tone Analyzer service. The service neither logs nor retains data from requests and responses, regardless of whether the `X-Watson-Learning-Opt-Out` request header is set.

## Install

Via Composer

``` bash
$ composer require adam-paterson/watson-tone-analyzer php-http/guzzle6-adapter
```

**Note:** This library uses an abstraction layer called HTTPlug which decouples it from any HTTP messaging client. To see which adapters are available and learn more visit: http://httplug.io/.

## Usage
### General Tone
``` php

/** @var $service IBM\Watson\ToneAnalyzer\Client */
$service = IBM\Watson\ToneAnalyzer\Client::create('username', 'password');

/** @var $analysis \IBM\Watson\ToneAnalyzer\Model\ToneAnalysis */
$analysis = $service->tone()->analyze('My fake plants died because I did not pretend to water them.', [
    'content_language' => 'en',
    'accept_language' => 'en',
    'sentences' => true
]);

/** @var $documentAnalysis \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis */
$documentAnalysis = $analysis->getDocumentAnalysis();

foreach ($documentAnalysis->getTones() as $tone) {
    /** @var $tone \IBM\Watson\ToneAnalyzer\Model\ToneScore */
    echo $tone->getName() . ': ' . $tone->getScore() . PHP_EOL;
}

// Sadness: 0.6165
// Analytical: 0.829888

$sentenceAnalysis = $analysis->getSentenceAnalysis();

foreach ($sentenceAnalysis as $sentence) {
    echo sprintf('#%d - %s: ', $sentence->getId(), $sentence->getText()) . PHP_EOL;
    foreach ($sentence->getTones() as $tone) {
        echo $tone->getName() . ': ' . $tone->getScore() . PHP_EOL;
    }
}

// #0 - Team, I know that times are tough!
// Analytical: 0.801827
// #1 - Product sales have been disappointing for the past three quarters.
// Sadness: 0.771241
// Analytical: 0.687768
```

### Engagement Tone
```php

use IBM\Watson\ToneAnalyzer\Model\Utterance;

/** @var $service IBM\Watson\ToneAnalyzer\Client */
$service = IBM\Watson\ToneAnalyzer\Client::create('username', 'password');

$utterances = [
    Utterance::create([
        Utterance::KEY_TEXT => 'Hello, I\'m having a problem with your product.',
        Utterance::KEY_USER => 'customer'
    ]),
    Utterance::create([
        Utterance::KEY_TEXT => 'Sorry to hear that, let me know what\'s going on, please.',
        Utterance::KEY_USER => 'agent'
    ])
];

/** @var $analysis \IBM\Watson\ToneAnalyzer\Model\UtteranceAnalyses */
$analysis = $service->toneChat()->analyze($utterances);

/** @var $documentAnalysis \IBM\Watson\ToneAnalyzer\Model\UtteranceAnalyses */
$utteranceAnalysis = $analysis->getTones();

if (null !== $utteranceAnalysis->getWarning()) {
    echo $utterances->getWarning();
}

foreach ($utterances->getTones() as $tone) {
    /** @var $tone \IBM\Watson\ToneAnalyzer\Model\UtteranceAnalysis */
    echo sprintf('#%d - %s: ', $tone->getId(), $tone->getText()) . PHP_EOL;
    foreach ($tone->getTones() as $utteranceTone) {
        /** @var $utteranceTone \IBM\Watson\ToneAnalyzer\Model\ToneScore */
        echo $utteranceTone->getName() . ': ' . $utteranceTone->getScore() . PHP_EOL;
    }
}

// #0 - Hello, I'm having a problem with your product.
// Polite: 0.686361
// #1 - Sorry to hear that, let me know what's going on, please.
// Polite: 0.92724
// Sympathetic: 0.672499
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CODE_OF_CONDUCT](.github/CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hello[at]adampaterson.co.uk instead of using the issue tracker.

## Credits

- [Adam Paterson][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/adam-paterson/watson-tone-analyzer.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/adam-paterson/watson-tone-analyzer/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/adam-paterson/watson-tone-analyzer.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/adam-paterson/watson-tone-analyzer.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/adam-paterson/watson-tone-analyzer.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/adam-paterson/watson-tone-analyzer
[link-travis]: https://travis-ci.org/adam-paterson/watson-tone-analyzer
[link-scrutinizer]: https://scrutinizer-ci.com/g/adam-paterson/watson-tone-analyzer/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/adam-paterson/watson-tone-analyzer
[link-downloads]: https://packagist.org/packages/adam-paterson/watson-tone-analyzer
[link-author]: https://github.com/adam-paterson
[link-contributors]: ../../contributors
