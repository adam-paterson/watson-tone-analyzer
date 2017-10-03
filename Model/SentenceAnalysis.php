<?php

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\ApiResponseInterface;

class SentenceAnalysis implements ApiResponseInterface
{
    /**
     * @var array
     */
    private $sentences;

    /**
     * SentenceAnalysis constructor.
     *
     * @param array $sentences
     */
    public function __construct(array $sentences)
    {
        $this->sentences = $sentences;
    }

    /**
     * Create sentence analysis
     *
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\SentenceAnalysis
     */
    public static function create(array $data)
    {
        $sentences = [];

        if (!isset($data['sentences_tone'])) {
            return new self($sentences);
        }

        foreach ($data['sentences_tone'] as $sentenceTone) {
            $sentences[] = Sentence::create($sentenceTone);
        }

        return new self($sentences);
    }

    /**
     * Get sentences
     *
     * @return array
     */
    public function getSentences()
    {
        return $this->sentences;
    }
}
