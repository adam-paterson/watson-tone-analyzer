<?php

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\ApiResponseInterface;

class DocumentAnalysis implements ApiResponseInterface
{
    /**
     * @var array
     */
    private $tones;

    /**
     * DocumentAnalysis constructor.
     *
     * @param $tones
     */
    public function __construct(array $tones = [])
    {
        $this->tones = $tones;
    }

    /**
     * Create document analysis
     *
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis
     */
    public static function create(array $data)
    {
        $tones = [];
        foreach ($data['document_tone']['tones'] as $tone) {
            $tones[] = Tone::create($tone);
        }

        return new self($tones);
    }

    /**
     * Get document tones
     *
     * @return array
     */
    public function getTones()
    {
        return $this->tones;
    }
}
