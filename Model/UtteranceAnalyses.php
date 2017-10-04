<?php

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\ApiResponseInterface;

class UtteranceAnalyses implements ApiResponseInterface
{
    /**
     * @var array
     */
    private $utterances;

    /**
     * UtteranceAnalyses constructor.
     *
     * @param $utterances
     */
    public function __construct(array $utterances)
    {
        $this->utterances = $utterances;
    }

    /**
     * Create utterance instance
     *
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\UtteranceAnalyses
     */
    public static function create(array $data)
    {
        $utterances = [];

        foreach ($data['utterances_tone'] as $utteranceTone) {
            $utterances[] = Utterance::create($utteranceTone);
        }

        return new self($utterances);
    }

    /**
     * Get utterances
     *
     * @return array
     */
    public function getUtterances()
    {
        return $this->utterances;
    }
}
