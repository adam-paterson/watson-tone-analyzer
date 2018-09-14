<?php

namespace IBM\Watson\ToneAnalyzer\tests\Model;

use IBM\Watson\Common\tests\Api\AbstractTestCase;
use IBM\Watson\ToneAnalyzer\Model\SentenceAnalysis;

class SentenceAnalysisTest extends AbstractTestCase
{
    public function testSentences()
    {
        $response = $this->getMockResponse('ToneResponse.json');
        $data = json_decode($response->getBody(), true);

        $sentence = $data['sentences_tone'][0];

        $analysis = SentenceAnalysis::create($sentence);

        $this->assertSame(0, $analysis->getId());
        $this->assertSame('Team, I know that times are tough!', $analysis->getText());
        $this->assertNotEmpty($analysis->getTones());
    }
}
