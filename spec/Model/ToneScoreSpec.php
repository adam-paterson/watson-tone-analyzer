<?php


namespace spec\IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\ToneAnalyzer\Model\ToneScore;
use PhpSpec\ObjectBehavior;

class ToneScoreSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(0.7523, 'analytical', 'Analytical');
    }

    function it_is_initializable()
    {
        $this->shouldBeAnInstanceOf(ToneScore::class);
    }

    function it_should_get_score()
    {
        $this->getScore()->shouldReturn(0.7523);
    }

    function it_should_get_id()
    {
        $this->getId()->shouldReturn('analytical');
    }

    function it_should_get_name()
    {
        $this->getName()->shouldReturn('Analytical');
    }
}
