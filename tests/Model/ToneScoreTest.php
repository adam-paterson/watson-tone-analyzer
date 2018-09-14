<?php

namespace IBM\Watson\ToneAnalyzer\tests\Model;

use IBM\Watson\Common\tests\Api\AbstractTestCase;
use IBM\Watson\ToneAnalyzer\Model\ToneScore;

class ToneScoreTest extends AbstractTestCase
{
    public function testToneScore()
    {
        $response = $this->getMockResponse('ToneResponse.json');
        $data = json_decode($response->getBody(), true);

        $toneData = $data['document_tone']['tones'][0];

        $toneScore = ToneScore::create($toneData);

        $this->assertSame(0.6165, $toneScore->getScore());
        $this->assertSame('sadness', $toneScore->getId());
        $this->assertSame('Sadness', $toneScore->getName());
    }
}
