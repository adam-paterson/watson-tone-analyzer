<?php

namespace IBM\Watson\ToneAnalyzer\tests\Api;

use IBM\Watson\Common\tests\Api\AbstractTestCase;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use IBM\Watson\ToneAnalyzer\Api\ToneOptions;
use PHPUnit\Framework\Constraint\IsType;

class ToneTest extends AbstractTestCase
{
    public function testAnalyze()
    {
        $this->hydrator->shouldReceive('hydrate')->once()->andReturn(['document_tone' => [], 'sentences_tone' => []]);
        $response = $this->getMockResponse('ToneResponse.json');
        $this->httpClient->shouldReceive('sendRequest')->once()->andReturn($response);

        $api = new Tone($this->httpClient, $this->hydrator, $this->requestBuilder);
        $response = $api->isHtml(true)->analyze('text', [
            'content_language' => 'en',
            'accept_language' => 'fr'
        ]);

        $this->assertInternalType(IsType::TYPE_ARRAY, $response);
        $this->assertArrayHasKey('document_tone', $response);
        $this->assertArrayHasKey('sentences_tone', $response);
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\Api\BadRequestException
     * @expectedExceptionMessage Input text exceeded API limit of 131,072 bytes
     */
    public function testInputExceedsLimitException()
    {
        $response = $this->getMockResponse('ErrorResponse.json', 400);
        $this->httpClient->shouldReceive('sendRequest')->once()->andReturn($response);

        $api = new Tone($this->httpClient, $this->hydrator, $this->requestBuilder);
        $api->analyze('LARGE AMOUNT OF TEXT');
    }
}
