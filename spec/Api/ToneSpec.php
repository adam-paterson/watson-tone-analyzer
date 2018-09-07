<?php

namespace spec\IBM\Watson\ToneAnalyzer\Api;

use Http\Client\HttpClient;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\RequestBuilder;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ToneSpec extends ObjectBehavior
{
    function let(
        HttpClient $httpClient,
        HydratorInterface $hydrator,
        RequestBuilder $requestBuilder
    ) {
        $this->beConstructedWith(
            $httpClient,
            $hydrator,
            $requestBuilder
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Tone::class);
    }

    function it_should_analyze_tone()
    {

    }
}
