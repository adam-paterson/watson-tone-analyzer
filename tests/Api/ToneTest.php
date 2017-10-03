<?php

namespace IBM\Watson\ToneAnalyzer\tests\Api;

use GuzzleHttp\Psr7\Response;
use Http\Client\HttpClient;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\Hydrator\ModelHydrator;
use IBM\Watson\Common\RequestBuilder;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class ToneTest extends TestCase
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

    /**
     * @expectedException \IBM\Watson\Common\Exception\InsufficientPrivilegesException
     * @expectedExceptionMessage Not Authorized
     */
    public function testUnauthorized()
    {
        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () {
            return new Response(401, [], '{"error":"Not Authorized"}');
        });

        $tone = new Tone($this->httpClient, $this->hydrator, $this->requestBuilder);

        $tone->analyze('text');
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\NotFoundException
     * @expectedExceptionMessage Not Found
     */
    public function testNotFound()
    {
        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () {
            return new Response(404, [], '{"error":"Not Found"}');
        });

        $tone = new Tone($this->httpClient, $this->hydrator, $this->requestBuilder);
        $tone->analyze('text');
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\UnknownErrorException
     * @expectedExceptionMessage Unknown Error
     */
    public function testUnknownError()
    {
        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () {
            return new Response(900, [], '{"error":"Unknown Error"}');
        });

        $tone = new Tone($this->httpClient, $this->hydrator, $this->requestBuilder);
        $tone->analyze('text');
    }

    public function testDocumentToneAnalysis()
    {
        $rawResponse = '{"document_tone": {"tones": [{"score": 0.6165,"tone_id": "sadness","tone_name": "Sadness"}]}}';

        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () use ($rawResponse) {
            return new Response(200, ['Content-Type' => 'application/json'], $rawResponse);
        });

        $tone = new Tone($this->httpClient, $this->hydrator, $this->requestBuilder);

        $response = $tone->analyze(
            'text',
            ['content_language' => 'en', 'accept_language' => 'en', 'learning_opt_out' => true]
        );

        $tones = $response->getDocumentAnalysis()->getTones();

        $this->assertNotEmpty($tones);

        $firstTone = $tones[0];

        $this->assertEquals('sadness', $firstTone->getId());
        $this->assertEquals('Sadness', $firstTone->getName());
        $this->assertEquals(0.6165, $firstTone->getScore());
    }

    public function testSentenceToneAnaysis()
    {
        $rawResponse = '{
  "document_tone": {
    "tones": [
      {
        "score": 0.6165,
        "tone_id": "sadness",
        "tone_name": "Sadness"
      },
      {
        "score": 0.829888,
        "tone_id": "analytical",
        "tone_name": "Analytical"
      }
    ]
  },
  "sentences_tone": [
    {
      "sentence_id": 0,
      "text": "Team, I know that times are tough!",
      "tones": [
        {
          "score": 0.801827,
          "tone_id": "analytical",
          "tone_name": "Analytical"
        }
      ]
    },
    {
      "sentence_id": 1,
      "text": "Product sales have been disappointing for the past three quarters.",
      "tones": [
        {
          "score": 0.771241,
          "tone_id": "sadness",
          "tone_name": "Sadness"
        },
        {
          "score": 0.687768,
          "tone_id": "analytical",
          "tone_name": "Analytical"
        }
      ]
    },
    {
      "sentence_id": 2,
      "text": "We have a competitive product, but we need to do a better job of selling it!",
      "tones": [
        {
          "score": 0.506763,
          "tone_id": "analytical",
          "tone_name": "Analytical"
        }
      ]
    }
  ]
}';

        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () use ($rawResponse) {
            return new Response(200, ['Content-Type' => 'application/json'], $rawResponse);
        });

        $tone = new Tone($this->httpClient, $this->hydrator, $this->requestBuilder);

        $response = $tone->analyze('text', ['content_language' => 'en', 'accept_language' => 'en']);

        $sentences = $response->getSentenceAnalysis()->getSentences();

        $this->assertNotEmpty($sentences);

        $firstSentence = $sentences[0];

        $this->assertEquals(0, $firstSentence->getId());
        $this->assertEquals('Team, I know that times are tough!', $firstSentence->getText());

        $tones = $firstSentence->getTones();

        $this->assertNotEmpty($tones);
    }
}
