<?php

namespace IBM\Watson\ToneAnalyzer\tests\Model;

use IBM\Watson\Common\tests\Api\AbstractTestCase;
use IBM\Watson\ToneAnalyzer\Model\UtteranceAnalyses;
use IBM\Watson\ToneAnalyzer\Model\UtteranceAnalysis;
use PHPUnit\Framework\Constraint\IsType;

class UtteranceAnalysesTest extends AbstractTestCase
{
    public function testCreate()
    {
        $response = $this->getMockResponse('ToneChatResponse.json');
        $data = json_decode($response->getBody(), true);

        $utteranceAnalyses = UtteranceAnalyses::create($data);

        $this->assertInstanceOf(UtteranceAnalyses::class, $utteranceAnalyses);
    }

    public function testGetTones()
    {
        $response = $this->getMockResponse('ToneChatResponse.json');
        $data = json_decode($response->getBody(), true);

        $utteranceAnalyses = UtteranceAnalyses::create($data);

        $this->assertInstanceOf(UtteranceAnalyses::class, $utteranceAnalyses);
        $this->assertInternalType(IsType::TYPE_ARRAY, $utteranceAnalyses->getTones());
    }

    public function testGetWarning()
    {
        $response = $this->getMockResponse('ToneChatResponse.json');
        $data = json_decode($response->getBody(), true);

        $utteranceAnalyses = UtteranceAnalyses::create($data);

        $this->assertSame('Content contains more than 50 utterances.', $utteranceAnalyses->getWarning());
    }
}
