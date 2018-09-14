<?php

namespace IBM\Watson\ToneAnalyzer\tests\Model;

use IBM\Watson\Common\tests\Api\AbstractTestCase;
use IBM\Watson\ToneAnalyzer\Model\UtteranceAnalyses;
use IBM\Watson\ToneAnalyzer\Model\UtteranceAnalysis;
use PHPUnit\Framework\Constraint\IsType;

class UtteranceAnalysisTest extends AbstractTestCase
{
    private $response;

    public function setUp()
    {
        parent::setUp();
        $this->response = $this->getMockResponse('ToneChatResponse.json');
    }


    public function testGetError()
    {
        $data = json_decode($this->response->getBody(), true);

        $utteranceAnalysis = UtteranceAnalysis::create($data[UtteranceAnalyses::KEY_TONE][0]);

        $this->assertNull($utteranceAnalysis->getError());
    }

    public function testGetId()
    {
        $data = json_decode($this->response->getBody(), true);

        $utteranceAnalysis = UtteranceAnalysis::create($data[UtteranceAnalyses::KEY_TONE][0]);

        $this->assertSame(0, $utteranceAnalysis->getId());
    }

    public function testGetText()
    {
        $data = json_decode($this->response->getBody(), true);

        $utteranceAnalysis = UtteranceAnalysis::create($data[UtteranceAnalyses::KEY_TONE][0]);

        $this->assertSame('Hello, I\'m having a problem with your product.', $utteranceAnalysis->getText());
    }

    public function testCreate()
    {
        $data = json_decode($this->response->getBody(), true);

        $utteranceAnalysis = UtteranceAnalysis::create($data[UtteranceAnalyses::KEY_TONE][0]);

        $this->assertInstanceOf(UtteranceAnalysis::class, $utteranceAnalysis);
    }

    public function testGetTones()
    {
        $data = json_decode($this->response->getBody(), true);

        $utteranceAnalysis = UtteranceAnalysis::create($data[UtteranceAnalyses::KEY_TONE][0]);

        $this->assertInternalType(IsType::TYPE_ARRAY, $utteranceAnalysis->getTones());
    }
}
