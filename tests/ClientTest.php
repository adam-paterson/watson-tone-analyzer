<?php

namespace IBM\Watson\ToneAnalyzer\tests;

use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use IBM\Watson\ToneAnalyzer\Api\ToneChat;
use PHPUnit\Framework\TestCase;
use Http\Client\HttpClient;
use IBM\Watson\Common\Hydrator\ArrayHydrator;
use IBM\Watson\ToneAnalyzer\Client;
use Mockery as m;

class ClientTest extends TestCase
{
    private $httpClient;
    private $hydrator;
    private $requestBuilder;

    public function setUp()
    {
        $this->httpClient = m::mock(HttpClient::class);
        $this->hydrator = m::mock(HydratorInterface::class);
        $this->requestBuilder = m::mock();
    }

    public function testCreate()
    {
        $client = Client::create('adam', 'password');

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testTone()
    {
        $client = Client::create('adam', 'password');

        $this->assertInstanceOf(Tone::class, $client->tone());
    }

    public function testToneChat()
    {
        $client = Client::create('adam', 'password');

        $this->assertInstanceOf(ToneChat::class, $client->toneChat());
    }
}
