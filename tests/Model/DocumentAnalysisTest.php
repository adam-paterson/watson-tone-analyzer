<?php

namespace IBM\Watson\ToneAnalyzer\tests\Model;

use IBM\Watson\Common\tests\Api\AbstractTestCase;
use IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis;

class DocumentAnalysisTest extends AbstractTestCase
{
    public function testTones()
    {
        $response = $this->getMockResponse('ToneResponse.json');
        $data = json_decode($response->getBody(), true);

        $document = $data['document_tone'];
        $document['warning'] = 'Content contains more than 50 utterances';

        $analysis = DocumentAnalysis::create($document);

        $this->assertNotEmpty($analysis->getTones());
        $this->assertSame('Content contains more than 50 utterances', $analysis->getWarning());
    }
}
