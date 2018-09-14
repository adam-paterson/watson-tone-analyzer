<?php

namespace IBM\Watson\ToneAnalyzer\tests\Model;

use IBM\Watson\Common\Api\AbstractApi;
use IBM\Watson\Common\tests\Api\AbstractTestCase;
use IBM\Watson\ToneAnalyzer\Model\ToneAnalysis;
use PHPUnit\Framework\TestCase;

class ToneAnalysisTest extends AbstractTestCase
{
    public function testToneAnalysis()
    {
        $response = $this->getMockResponse('ToneResponse.json');
        $data = json_decode($response->getBody(), true);

        $analysis = ToneAnalysis::create($data);

        $this->assertNotEmpty($analysis->getDocumentAnalysis());
        $this->assertNotEmpty($analysis->getSentenceAnalysis());
    }
}
