<?php

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\CreateableFromArray;

/**
 * Class ToneAnalysis
 */
class ToneAnalysis implements CreateableFromArray
{
    /**
     * @var string
     */
    const KEY_DOCUMENT_TONE = 'document_tone';

    /**
     * @var string
     */
    const KEY_SENTENCE_TONE = 'sentences_tone';

    /**
     * @var \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis
     */
    private $documentAnalysis;

    /**
     * @var array
     */
    private $sentenceAnalysis;

    /**
     * @param \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis $documentAnalysis
     * @param array                                           $sentenceAnalysis
     */
    public function __construct(DocumentAnalysis $documentAnalysis, array $sentenceAnalysis = [])
    {
        $this->documentAnalysis = $documentAnalysis;
        $this->sentenceAnalysis = $sentenceAnalysis;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\ToneAnalysis
     */
    public static function create(array $data)
    {
        $sentenceTone = [];

        if (isset($data[static::KEY_SENTENCE_TONE])) {
            foreach ($data[static::KEY_SENTENCE_TONE] as $sentence) {
                $sentenceTone[] = SentenceAnalysis::create($sentence);
            }
        }

        return new self(
            DocumentAnalysis::create($data[static::KEY_DOCUMENT_TONE]),
            $sentenceTone
        );
    }

    /**
     * @return \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis
     */
    public function getDocumentAnalysis()
    {
        return $this->documentAnalysis;
    }

    /**
     * @return array
     */
    public function getSentenceAnalysis()
    {
        return $this->sentenceAnalysis;
    }
}
