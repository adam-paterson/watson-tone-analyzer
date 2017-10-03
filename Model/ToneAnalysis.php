<?php

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\ApiResponseInterface;

class ToneAnalysis implements ApiResponseInterface
{
    /**
     * @var \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis
     */
    private $documentAnalysis;

    /**
     * @var \IBM\Watson\ToneAnalyzer\Model\SentenceAnalysis
     */
    private $sentenceAnalysis;

    /**
     * ToneAnalysis constructor.
     *
     * @param \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis $documentAnalysis
     * @param \IBM\Watson\ToneAnalyzer\Model\SentenceAnalysis $sentenceAnalysis
     */
    public function __construct(DocumentAnalysis $documentAnalysis, SentenceAnalysis $sentenceAnalysis)
    {
        $this->documentAnalysis = $documentAnalysis;
        $this->sentenceAnalysis = $sentenceAnalysis;
    }

    /**
     * Create tone analysis
     *
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\ToneAnalysis
     */
    public static function create(array $data)
    {
        $documentAnalysis = DocumentAnalysis::create($data);
        $sentenceAnalysis = SentenceAnalysis::create($data);

        return new self($documentAnalysis, $sentenceAnalysis);
    }

    /**
     * Get document level analysis
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis
     */
    public function getDocumentAnalysis()
    {
        return $this->documentAnalysis;
    }

    /**
     * Get sentence level analysis
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\SentenceAnalysis
     */
    public function getSentenceAnalysis()
    {
        return $this->sentenceAnalysis;
    }
}
