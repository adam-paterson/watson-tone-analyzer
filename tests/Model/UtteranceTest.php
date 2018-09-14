<?php

namespace IBM\Watson\ToneAnalyzer\tests\Model;

use IBM\Watson\ToneAnalyzer\Model\Utterance;
use PHPUnit\Framework\TestCase;

class UtteranceTest extends TestCase
{
    private $utterance;

    public function setUp()
    {
        $this->utterance = Utterance::create([
            Utterance::KEY_USER => 'user',
            Utterance::KEY_TEXT => 'text'
        ]);
    }

    public function testCreate()
    {
        $this->assertInstanceOf(Utterance::class, $this->utterance);
    }

    public function testGetUser()
    {
        $this->assertSame('user', $this->utterance->getUser());
    }

    public function testGetText()
    {
        $this->assertSame('text', $this->utterance->getText());
    }
}
