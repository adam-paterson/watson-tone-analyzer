<?php

namespace IBM\Watson\ToneAnalyzer\tests\Api;

use IBM\Watson\Common\Hydrator\ModelHydrator;
use IBM\Watson\Common\tests\Api\AbstractTestCase;
use IBM\Watson\ToneAnalyzer\Api\ToneChat;
use IBM\Watson\ToneAnalyzer\Model\UtteranceAnalyses;
use PHPUnit\Framework\Constraint\IsType;

class ToneChatTest extends AbstractTestCase
{
    /**
     * @dataProvider utteranceProvider
     *
     * @param array $utterances
     */
    public function testAnalyze($utterances)
    {
        $response = $this->getMockResponse('ToneChatResponse.json');
        $this->httpClient->shouldReceive('sendRequest')->once()->andReturn($response);
        $this->hydrator->shouldReceive('hydrate')->once()->andReturn(
            (new ModelHydrator())->hydrate($response, UtteranceAnalyses::class)
        );

        $api = new ToneChat($this->httpClient, $this->hydrator, $this->requestBuilder);
        $response = $api->analyze($utterances);

        $this->assertInstanceOf(UtteranceAnalyses::class, $response);
        $this->assertInternalType(IsType::TYPE_ARRAY, $response->getTones());
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\Domain\UnknownErrorException
     * @expectedExceptionMessage Input text exceeded API limit of 131,072 bytes
     */
    public function testHydratorThrowsExceptions()
    {
        $response = $this->getMockResponse('ErrorResponse.json', 500);
        $this->httpClient->shouldReceive('sendRequest')->once()->andReturn($response);

        $api = new ToneChat($this->httpClient, $this->hydrator, $this->requestBuilder);
        $api->analyze([]);
    }

    public static function utteranceProvider()
    {
        return [
            [
                [
                    [
                        'text' => 'Hello, I\'m having a problem with your product.',
                        'user' => 'customer',
                    ],
                    [
                        'text' => 'OK, let me know what\'s going on, please.',
                        'user' => 'agent',
                    ],
                    [
                        'text' => 'Well, nothing is working :(',
                        'user' => 'customer',
                    ],
                    [
                        'text' => 'Sorry to hear that',
                        'user' => 'agent',
                    ],
                ],
            ],
        ];
    }
}
