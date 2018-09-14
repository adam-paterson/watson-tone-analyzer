<?php

namespace spec\IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DocumentAnalysisSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DocumentAnalysis::class);
    }

    function it_should_get_tones()
    {
        $analysis = $this::create([
            'tones' => [],
            'warning' => 'A warning'
        ]);

        $analysis->getTones()->shouldBeArray();
        $analysis->getWarning()->shouldBeString();
    }
}
