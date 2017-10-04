<?php

namespace IBM\Watson\ToneAnalyzer\tests\Api;

use GuzzleHttp\Psr7\Response;
use Http\Client\HttpClient;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\Hydrator\ModelHydrator;
use IBM\Watson\Common\RequestBuilder;
use IBM\Watson\ToneAnalyzer\Api\ToneChat;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class ToneChatTest extends TestCase
{
    private $httpClient;
    private $hydrator;
    private $requestBuilder;

    public function setUp()
    {
        $this->httpClient = m::mock(HttpClient::class);
        $this->hydrator = m::mock(new ModelHydrator(), HydratorInterface::class);
        $this->requestBuilder = new RequestBuilder();
    }

    public function testToneChatAnalysis()
    {
        $rawResponse = '{
  "utterances_tone": [
    {
      "utterance_id": 0,
      "utterance_text": "If you\'re sending someone some Styrofoam, what do you pack it in?",
      "tones": [
        {
          "score": 0.711722,
          "tone_id": "polite",
          "tone_name": "polite"
        }
      ]
    }
  ]
}';
        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () use ($rawResponse) {
            return new Response(200, ['Content-Type' => 'application/json'], $rawResponse);
        });

        $toneChat = new ToneChat($this->httpClient, $this->hydrator, $this->requestBuilder);

        $response = $toneChat->analyze(
            '{"utterances": [{"text": "If you\'re sending someone some Styrofoam, what do you pack it in?", "user": "customer"}]}'
        );

        $utterances = $response->getUtterances();

        $this->assertNotEmpty($utterances);

        $firstUtterance = $utterances[0];

        $this->assertEquals(0, $firstUtterance->getId());
        $this->assertEquals('If you\'re sending someone some Styrofoam, what do you pack it in?', $firstUtterance->getText());
        $tones = $firstUtterance->getTones();

        $this->assertNotEmpty($tones);

        $firstTone = $tones[0];

        $this->assertEquals('polite', $firstTone->getId());
        $this->assertEquals('polite', $firstTone->getName());
        $this->assertEquals(0.711722, $firstTone->getScore());
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\UnknownErrorException
     */
    public function testToneChatErrors()
    {
        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () {
            return new Response(900, [], '{"error":"Unknown Error"}');
        });

        $toneChat = new ToneChat($this->httpClient, $this->hydrator, $this->requestBuilder);
        $toneChat->analyze('text');
    }
}
