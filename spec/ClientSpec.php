<?php

namespace spec\IBM\Watson\ToneAnalyzer;

use IBM\Watson\Common\AbstractClient;
use IBM\Watson\Common\Api\AbstractApi;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use IBM\Watson\ToneAnalyzer\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
        $this->shouldHaveType(AbstractClient::class);
    }

    function it_should_use_tone_api()
    {
        $this->tone()->shouldReturnAnInstanceOf(Tone::class);
        $this->tone()->shouldReturnAnInstanceOf(AbstractApi::class);
    }
}
