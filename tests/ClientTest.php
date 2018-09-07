<?php

namespace IBM\Watson\ToneAnalyzer\tests;

use Http\Client\HttpClient;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\RequestBuilder;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use IBM\Watson\ToneAnalyzer\Client;
use PHPUnit\Framework\TestCase;
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
        $this->requestBuilder = m::mock(RequestBuilder::class);
    }

    public function testCreate()
    {
        $client = Client::create('username', 'password');
        $this->assertInstanceOf(Client::class, $client);
    }

    public function testTone()
    {
        $client = new Client($this->httpClient, $this->hydrator, $this->requestBuilder);

        $this->assertInstanceOf(Tone::class, $client->tone());
    }
}